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
use Omega\Database\Exceptions\ConnectionException;
use Omega\Database\Migration\MysqlMigration;
use Omega\Database\QueryBuilder\MysqlQueryBuilder;
use Pdo;

/**
 * MySQL adapter class.
 *
 * The `MysqleDatabaseAdapter` class is an implementation of the abstract `AbstractDatabaseAdapter`
 * and is specifically tailored for MySQL database connections. This adapter provides mysql-specific
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
class MysqlAdapter extends AbstractDatabaseAdapter
{
    /**
     * Database name.
     *
     * @var string $database Holds the database name.
     */
    private string $database;

    /**
     * MySQL class constructor.
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
     * @inheritdoc
     *
     * @return AbstractQueryBuilder An instance of the AbstractQueryBuilder class for constructing SQL queries.
     */
    public function query() : MysqlQueryBuilder
    {
        return new MysqlQueryBuilder( $this );
    }

    /**
     * @inheritdoc
     *
     * @param  string $table The name of the table to create.
     * @return  AbstractMigration Returns an instance of the AbstractMigration class for managing table creation.
     */
    public function createTable( string $table ) : MysqlMigration
    {
        return new MysqlMigration( $this, $table, 'create' );
    }

    /**
     * @inheritdoc
     *
     * @param  string $table The name of the table to modify.
     * @return AbstractMigration Returns an instance of the AbstractMigration class for managing table alterations.
     */
    public function alterTable( string $table ) : MysqlMigration
    {
        return new MysqlMigration( $this, $table, 'alter' );
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     *
     * @return int Returns 1 if all tables are successfully dropped, or false if any issues occur during the process.
     */
    public function dropTables() : int|bool
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
