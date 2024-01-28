<?php
/**
 * Part of Omega CMS - Commands Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 */

/**
 * @declare
 */
declare( strict_types = 1 );

/**
 * @namespace
 */
namespace Omega\Database\Commands;

/**
 * @use
 */
use function getcwd;
use function glob;
use Omega\Helpers\App;
use Omega\Database\Adapter\AbstractDatabaseAdapter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Migrate command class.
 *
 * The `MigrateCommand` is used to run database migrations. It looks for migration
 * files in the specified directory and executes them. You can also use the `--fresh`
 * option to delete all database tables before running migrations.
 *
 * @category    Omega
 * @package     Omega\Commands
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class MigrateCommand extends Command
{
    /**
     * Default command name.
     *
     * @var string $defaultName Holds the default command name.
     */
    protected static $defaultName = 'migrate';

    /**
     * Configures the current command.
     *
     * This method configures the command description, options, and help information.
     *
     * @return void
     */
    protected function configure() : void
    {
        $this
            ->setDescription( 'Migrates the database' )
            ->addOption( 'fresh', null, InputOption::VALUE_NONE, 'Delete all tables before running the migrations' )
            ->setHelp( 'This command looks for all migration files and runs them' );
    }

    /**
     * Executes the current command.
     *
     * This method runs database migrations by looking for migration files and executing
     * them in order. It also provides an option to delete all database tables before
     * running migrations.
     *
     * @param  InputInterface  $input  Holds an instance of InputInterface.
     * @param  OutputInterface $output Holds an instance of OutputInterface.
     * @return int Return 0 if everything went fine, or an exit code.
     */
    protected function execute( InputInterface $input, OutputInterface $output ) : int
    {
        $current = getcwd();
        $pattern = 'database/migrations/*.php';

        $paths = glob( "{$current}/{$pattern}" );

        if ( count( $paths ) < 1 ) {
            $this->writeln( 'No migrations found' );
            return Command::SUCCESS;
        }

        $connection = App::application('database');

        if ( $input->getOption( 'fresh' ) ) {
            $output->writeln( 'Dropping existing database tables' );

            $connection->dropTables();
            $connection = App::application('database');
        }

        if ( ! $connection->hasTable( 'migrations' ) ) {
            $output->writeln( 'Creating migrations table' );
            $this->createMigrationsTable( $connection );
        }

        foreach ( $paths as $path ) {
            [ $prefix, $file     ] = explode( '_', $path );
            [ $class, $extension ] = explode( '.', $file );

            require $path;

            $output->writeln( "Migrating: {$class}" );

            $obj = new $class();
            $obj->migrate( $connection );

            $connection
                ->query()
                ->from( 'migrations' )
                ->insert( [ 'name' ], [ 'name' => $class ] );
        }

        return Command::SUCCESS;
    }


    /**
     * Create migration table.
     *
     * @param  AbstractDatabaseAdapter $connection Holds an instance of AbstractDatabaseAdapter.
     * @return void
     */
    private function createMigrationsTable( AbstractDatabaseAdapter $connection ) : void
    {
        $table = $connection->createTable( 'migrations' );
        $table->id( 'id' );
        $table->string( 'name' );
        $table->execute();
    }
}