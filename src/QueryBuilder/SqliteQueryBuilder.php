<?php
/**
 * Part of Omega CMS -  Database Package
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
namespace Omega\Database\QueryBuilder;

/**
 * @use
 */
use Omega\Database\Adapter\SqliteAdapter;

/**
 * Mysql query builder class.
 *
 * This `SqliteQueryBuilder` class provides methods to build and execute Sqlite queries. It extends
 *  the abstract query builder class, implementing Sqlite-specific functionality. It is designed to
 *  work with the SqliteAdapter for database connections.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\QueryBuilder
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class SqliteQueryBuilder extends AbstractQueryBuilder
{
    /**
     * Sqlite connection object.
     *
     * @var SqliteAdapter $connection Holds the Sqlite connection object.
     */
    protected SqliteAdapter $connection;

    /**
     * SqliteQueryBuilder class constructor.
     *
     * @param  SqliteAdapter $connection Holds an instance of the SqliteAdapter for database connection.
     * @return void
     */
    public function __construct( SqliteAdapter $connection )
    {
        $this->connection = $connection;
    }
}