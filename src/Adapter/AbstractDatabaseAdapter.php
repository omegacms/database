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
use function in_array;
use Omega\Database\Migration\AbstractMigration;
use Omega\Database\QueryBuilder\AbstractQueryBuilder;
use Pdo;

/**
 * Abstract database adapter class.
 *
 * The `AbstractDatabaseAdapter` is designed to provide a basic abstraction for database
 * connection and management. This class is declared as abstract and offers a basic implementation
 * of several methods defined in the `DatabaseAdapterInterface` interface.
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
abstract class AbstractDatabaseAdapter implements DatabaseAdapterInterface
{
    /**
     * Pdo instance.
     *
     * @var Pdo $pdo Holds an instance of Pdo.
     */
    public Pdo $pdo;

    /**
     * @inheritdoc
     *
     * @return Pdo Returns the current PDO instance that represents the database connection.
     */
    public function pdo() : Pdo
    {
        return $this->pdo;
    }

    /**
     * @inheritdoc
     *
     * @param  string $name The name of the table to check.
     * @return bool Returns true if the specified table exists, otherwise returns false.
     */
    public function hasTable( string $name ) : bool
    {
        $tables = $this->getTables();

        return in_array( $name, $tables );
    }

    /**
     * @inheritdoc
     *
     * @return AbstractQueryBuilder An instance of the AbstractQueryBuilder class for constructing SQL queries.
     */
    abstract public function query() : AbstractQueryBuilder;

    /**
     * @inheritdoc
     *
     * @param  string $table The name of the table to create.
     * @return  AbstractMigration Returns an instance of the AbstractMigration class for managing table creation.
     */
    abstract public function createTable( string $table ) : AbstractMigration;

    /**
     * @inheritdoc
     *
     * @param  string $table The name of the table to modify.
     * @return AbstractMigration Returns an instance of the AbstractMigration class for managing table alterations.
     */
    abstract public function alterTable( string $table ) : AbstractMigration;

    /**
     * @inheritdoc
     *
     * @return array Returns an array of table names available on this connection.
     */
    abstract public function getTables() : array;

    /**
     * @inheritdoc
     *
     * @return int Returns 1 if all tables are successfully dropped, or false if any issues occur during the process.
     */
    abstract public function dropTables() : int;
}
