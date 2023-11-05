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
use Omega\Database\Exceptions\ConnectionException;
use Omega\Database\Migration\MysqlMigration;
use Omega\QueryBuilder\MysqlQueryBuilder;
use Pdo;

/**
 * Mysql adapter class.
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
class MysqlAdapter extends AbstractDatabaseAdapter
{
    /**
     * Database name.
     * 
     * @var string $database Holds the database name. 
     */
    private string $database;

    /**
     * Sqlite class constructor.
     *
     * @param  array $config Holds an array of configuration params.
     * @return void
     */
    public function __construct( array $config )
    {
        [
            'host'     => $host,
            'port'     => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password,
        ] = $config;

        if ( empty( $host ) || empty( $database ) || empty( $username ) ) {
            throw new ConnectionException(
                'Connection incorrectly configured'
            );
        }

        $this->database = $database;

        $this->pdo = new Pdo( "mysql:host={$host};port={$port};dbname={$database}", $username, $password );
    }

    /**
     * Start a new query on this connection.
     *
     * @return MysqlQueryBuilder Return an instance of MysqlQueryBuilder.
     */
    public function query() : MysqlQueryBuilder
    {
        return new MysqlQueryBuilder( $this );
    }

    /**
     * Start a new migration to add a table on this connection.
     *
     * @return MysqlMigration Return an instance of MysqlMigration.
     */
    public function createTable( string $table ) : MysqlMigration
    {
        return new MysqlMigration( $this, $table, 'create' );
    }

    /**
     * Start a new migration to add a table on this connection.
     *
     * @return MysqlMigration Return an instance of MysqlMigration.
     */
    public function alterTable( string $table ) : MysqlMigration
    {
        return new MysqlMigration( $this, $table, 'alter' );
    }

    /**
     * Get table names on this connection.
     *
     * @return array Return a list of table names on this connection.
     */
    public function getTables() : array
    {
        $statement = $this->pdo->prepare( 'SHOW TABLES' );
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
        $statement = $this->pdo->prepare( "
            SELECT CONCAT('DROP TABLE IF EXISTS `', table_name, '`')
            FROM information_schema.tables
            WHERE table_schema = '{$this->database}';
        " );

        $statement->execute();

        $dropTableClauses = $statement->fetchAll( PDO::FETCH_NUM );
        $dropTableClauses = array_map( fn( $result ) => $result[ 0 ], $dropTableClauses );

        $clauses = [
            'SET FOREIGN_KEY_CHECKS = 0',
            ...$dropTableClauses,
            'SET FOREIGN_KEY_CHECKS = 1',
        ];

        $statement = $this->pdo->prepare( join( ';', $clauses ) . ';' );

        return $statement->execute();
    }
}