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
declare( strict_types = 1 );

/**
 * @namespace
 */
namespace Omega\Database\Adapter;

/**
 * @use
 */
use function in_array;
use Omega\Database\Migration\AbstractMigration;
use Omega\QueryBuilder\AbstractQueryBuilder;
use Pdo;

/**
 * Abstract connection class.
 *
 * @category    Omega
 * @package     Framework\Database
 * @subpackage  Omega\Database\Connection
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
abstract class AbstractDatabaseAdapter implements DatabaseAdapterInterface
{
    /**
     * Pdo instance.
     *
     * @var Pdo $pdo Holds an instance of Pdo.
     */
    public Pdo $pdo;

    /**
     * Get the underlying Pdo instance for this connection.
     *
     * @return Pdo Return an instance of Pdo.
     */
    public function pdo() : Pdo
    {
        return $this->pdo;
    }

    /**
     * Find out if a table exists on this connection.
     *
     * @param  string $name Holds the table name.
     * @return bool Return true if table exists on this connection.
     */
    public function hasTable( string $name ) : bool
    {
        $tables = $this->getTables();

        return in_array( $name, $tables );
    }

    /**
     * Start a new query on this connection.
     *
     * @return AbstractQueryBuilder Return an instance of AbstractQueryBuilder.
     */
    abstract public function query() : AbstractQueryBuilder;

    /**
     * Start a new migration to add a table on this connection.
     *
     * @return AbstractMigration Return an instance of AbstractMigration.
     */
    abstract public function createTable( string $table ) : AbstractMigration;

    /**
     * Start a new migration to add a table on this connection.
     *
     * @return AbstractMigration Return an instance of AbstractMigration.
     */
    abstract public function alterTable( string $table ) : AbstractMigration;

    /**
     * Get table names on this connection.
     *
     * @return array Return a list of table names on this connection.
     */
    abstract public function getTables() : array;

    /**
     * Drop all tables in the current database.
     *
     * @return int
     */
    abstract public function dropTables() : int;
}