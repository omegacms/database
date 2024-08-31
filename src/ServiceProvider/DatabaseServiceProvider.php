<?php
/**
 * Part of Omega CMS - Database Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 */

/**
 * @declare
 */
declare( strict_types = 1 );

/**
 * @namespace
 */
namespace Omega\Database\ServiceProvider;

/**
 * @use
 */
use Closure;
use Omega\Database\Adapter\MysqlAdapter;
use Omega\Database\Adapter\SqliteAdapter;
use Omega\Database\DatabaseFactory;
use Omega\Container\ServiceProvider\AbstractServiceProvider;
use Omega\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Database service provider class.
 *
 * The `DatabaseServiceProvider` class managing the database connection. This service
 * provider is responsible for creating and managing instances of the DatabaseFactory
 * and providing drivers for different database types such as SQLite and MySQL.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\ServiceProvider
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritdoc
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'database';
    }

    /**
     * @inheritdoc
     *
     * @return ServiceProviderInterface Return an instance of ServiceProviderIntrface.
     */
    protected function factory() : ServiceProviderInterface
    {
        return new DatabaseFactory();
    }

    /**
     * @inheritdoc
     *
     * @return array<string, Closure> Return an array of drivers for the service.
     */
    protected function drivers() : array
    {
        return [
            'sqlite' => function ( $config ) {
                return new SqliteAdapter( $config );
            },
            'mysql'  => function ( $config ) {
                return new MysqlAdapter( $config );
            },
        ];
    }
}
