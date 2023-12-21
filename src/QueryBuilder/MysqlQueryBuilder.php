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
use Omega\Database\Adapter\MysqlAdapter;

/**
 * Mysql query builder class.
 *
 * This `MysqlQueryBuilder` class provides methods to build and execute MySQL queries. It extends
 * the abstract query builder class, implementing MySQL-specific functionality. It is designed to
 * work with the MySQLAdapter for database connections.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\QueryBuilder
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class MysqlQueryBuilder extends AbstractQueryBuilder
{
    /**
     * MySQL connection object.
     *
     * @var MysqlAdapter $connection Holds an instance of the MySQL connection object.
     */
    protected MysqlAdapter $connection;

    /**
     * MysqlQueryBuilder class constructor.
     *
     * @param  MysqlAdapter $connection Holds an instance of the MySQLAdapter for database connection.
     * @return void
     */
    public function __construct( MysqlAdapter $connection )
    {
        $this->connection = $connection;
    }
}