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
namespace Omega\QueryBuilder;

/**
 * @use
 */
use Omega\Database\Adapter\MysqlAdapter;

/**
 * Mysql query builder class.
 *
 * @category    Omega
 * @package     Omega\QueryBuilder
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class MysqlQueryBuilder extends AbstractQueryBuilder
{
    /**
     * Mysql connection object.
     *
     * @var MysqlAdapter $connection Holds the Mysql connection object.
     */
    protected MysqlAdapter $connection;

    /**
     * MysqlQueryBuilder class constructor.
     *
     * @param  MysqlAdapter $connection Holds the Mysql connection object.
     * @return void
     */
    public function __construct( MysqlAdapter $connection )
    {
        $this->connection = $connection;
    }
}