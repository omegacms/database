<?php
/**
 * Part of Banco Omega CMS -  Database Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 */

/**
 * @declare
 */
//declare( strict_types = 1 );

/**
 * @namespace
 */
namespace Omega\Database\Adapter;

/**
 * @use
 */
use function array_map;
use function file_put_contents;
use Omega\Database\Exceptions\ConnectionException;
use Omega\Database\Migration\SqliteMigration;
use Omega\QueryBuilder\SqliteQueryBuilder;
use Pdo;

/**
 * Sqlite adapter class.
 *
 * @category    Omega
 * @package     Framework\Database
 * @subpackage  Omega\Database\Connection\Adapter
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
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
     */
    public function __construct( array $config )
    {
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
     * Start a new query on this connection.
     *
     * @return SqliteQueryBuilder Return an instance of SqliteQueryBuilder.
     */
    public function query() : SqliteQueryBuilder
    {
        return new SqliteQueryBuilder( $this );
    }

    /**
     * Start a new migration to add a table on this connection.
     *
     * @return SqliteMigration Return an instance of SqliteMigration.
     */
    public function createTable( string $table ) : SqliteMigration
    {
        return new SqliteMigration( $this, $table, 'create' );
    }

    /**
     * Start a new migration to add a table on this connection.
     *
     * @return SqliteMigration Return an instance of SqliteMigration.
     */
    public function alterTable( string $table ) : SqliteMigration
    {
        return new SqliteMigration( $this, $table, 'alter' );
    }

    /**
     * Get table names on this connection.
     *
     * @return array Return a list of table names on this connection.
     */
    public function getTables() : array
    {
        $statement = $this->pdo->prepare( "SELECT name FROM sqlite_master WHERE type = 'table'" );
        $statement->execute();

        $results = $statement->fetchAll( PDO::FETCH_NUM );

        return array_map( fn( $result ) => $result[ 0 ], $results );
    }

    /**
     * Drop all tables in the current database.
     *
     * @return int
     */
    public function dropTables() : int
    {
        file_put_contents( $this->config[ 'path' ], '' );

        return 1;
    }
}