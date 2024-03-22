<?php
/**
 * Part of Omega CMS - Database Package
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
namespace Omega\Database\Adapter;

/**
 * @use
 */
use function array_map;
use function extension_loaded;
use function file_put_contents;
use Omega\Database\Exceptions\AdapterException;
use Omega\Database\Exceptions\ConnectionException;
use Omega\Database\Migration\SqliteMigration;
use Omega\Database\QueryBuilder\SqliteQueryBuilder;
use Pdo;

/**
 * Sqlite adapter class.
 *
 * The `SqliteDatabaseAdapter` class is an implementation of the abstract `AbstractDatabaseAdapter`
 * and is specifically tailored for SQLite database connections. This adapter provides SQLite-specific
 * database management features while inheriting the common database functionality defined in the parent
 * class.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\Adapter
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class SqliteAdapter extends AbstractDatabaseAdapter
{
    /**
     * Config array.
     *
     * @var array $config Holds an array of configuration params.
     */
    private array $config;

    /**
     * Sqlite class constructor.
     *
     * @param  array $config Holds an array of configuration params.
     * @return void
     * @throws AdpterException if sqlite3 extension is not installed or not enabled.
     */
    public function __construct( array $config )
    {
        if ( ! extension_loaded( 'sqlite3' ) ) {
            throw new AdapterException(
                'The Sqlite3 extension is not enabled. Please make sure to install or enable the Sqlite3 extension to use database functionality.'
            );
        }

        [ 'path' => $path ] = $config;

        if ( empty( $path ) ) {
            throw new ConnectionException(
                'Connection incorrectly configured'
            );
        }

        $this->pdo = new Pdo( "sqlite:{$path}" );
        $this->config = $config;
    }

    /**
     * @inheritdoc
     *
     * @return AbstractQueryBuilder An instance of the AbstractQueryBuilder class for constructing SQL queries.
     */
    public function query() : SqliteQueryBuilder
    {
        return new SqliteQueryBuilder( $this );
    }

    /**
     * @inheritdoc
     *
     * @param  string $table The name of the table to create.
     * @return  AbstractMigration Returns an instance of the AbstractMigration class for managing table creation.
     */
    public function createTable( string $table ) : SqliteMigration
    {
        return new SqliteMigration( $this, $table, 'create' );
    }

    /**
     * @inheritdoc
     *
     * @param  string $table Holds the table name to alter.
     * @return MysqlMigration Return an instance of MysqlMigration.
     */
    public function alterTable( string $table ) : SqliteMigration
    {
        return new SqliteMigration( $this, $table, 'alter' );
    }

    /**
     * @inheritdoc
     *
     * @return array Returns an array of table names available on this connection.
     */
    public function getTables() : array
    {
        $statement = $this->pdo->prepare( "SELECT name FROM sqlite_master WHERE type = 'table'" );
        $statement->execute();

        $results = $statement->fetchAll( PDO::FETCH_NUM );

        return array_map( fn( $result ) => $result[ 0 ], $results );
    }

    /**
     * @inheritdoc
     *
     * @return int Returns 1 if all tables are successfully dropped, or false if any issues occur during the process.
     */
    public function dropTables() : int|bool
    {
    	$statement = $this->pdo->prepare( "SELECT name FROM sqlite_master WHERE type='table'" );
    	$statement->execute();
    	$tables    = $statement->fetchAll( PDO::FETCH_COLUMN );
        
        array_shift( $tables );

    	foreach ( $tables as $table ) {
        	$dropStatement = $this->pdo->prepare( "DROP TABLE IF EXISTS `$table`" );
        	$dropStatement->execute();
    	}

    	return 1;
    }
}
