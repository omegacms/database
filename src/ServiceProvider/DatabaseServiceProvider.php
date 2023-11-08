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
namespace Omega\Database\ServiceProvider;

/**
 * @use
 */
use Omega\Database\Adapter\MysqlAdapter;
use Omega\Database\Adapter\SqliteAdapter;
use Omega\Database\DatabaseFactory;
use Omega\ServiceProvider\AbstractServiceProvider;
use Omega\ServiceProvider\ServiceProviderInterface;

/**
 * Database service provider class.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\ServiceProvider
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * Get the service name.
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'database';
    }

    /**
     * Get the service factory.
     *
     * @return mixed
     */
    protected function factory() : ServiceProviderInterface
    {
        return new DatabaseFactory();
    }

    /**
     * Get drivers.
     *
     * @return array Return an array of drivers for the service.
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
