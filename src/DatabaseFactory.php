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
namespace Omega\Database;

/**
 * @use
 */
use Closure;
use Omega\Database\Adapter\AbstractDatabaseAdapter;
use Omega\Database\Exceptions\AdapterException;
use Omega\Container\ServiceProvider\ServiceProviderInterface;

/**
 * DatabaseFactory class.
 *
 * The `DatabaseFactory` class represents a factory for managing database adapters.
 * This class allows registration of database drivers and provides a method to connect
 * the appropriate driver based on the configuration.
 *
 * @category    Omega
 * @package     Omega\Database
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class DatabaseFactory implements ServiceProviderInterface
{
    /**
     * Database connectors.
     *
     * @var array $connectors Holds an array of database connectors.
     */
    protected array $connectors;

    /**
     * Add database driver.
     *
     * @param  string  $alias  Holds the driver alias.
     * @param  Closure $driver Holds an instance of Closure.
     * @return $this
     */
    public function register( string $alias, Closure $driver ) : static
    {
        $this->connectors[ $alias ] = $driver;

        return $this;
    }

    /**
     * Connect the driver.
     *
     * @param  array<string, mixed> $config Holds an array of configuration.
     * @return AbstractDatabaseAdapter Return an instance of AbstractDatabaseAdapter.
     * @throws AdapterException if the adapter is not defined or unrecognised.
     */
    public function bootstrap( array $config ) : AbstractDatabaseAdapter
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new AdapterException(
                'Adapter is not defined.'
            );
        }

        $type = $config[ 'type' ];

        if ( isset( $this->connectors[ $type ] ) ) {
            return $this->connectors[ $type ]( $config );
        }

        throw new AdapterException(
            'Adapter is unrecognised.'
        );
    }
}
