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
namespace Omega\Database\Factory;

/**
 * @use
 */
use Omega\Database\Adapter\DatabaseAdapterInterface;
use Omega\Database\Adapter\MysqlAdapter;
use Omega\Database\Adapter\SqliteAdapter;
use Omega\Database\Exception\AdapterException;

/**
 * Database factory class.
 *
 * The `DatabaseFactory` class is responsible for registering and creating session
 * drivers based on configurations. It acts as a factory for different session
 * drivers and provides a flexible way to connect to various session systems.
 *
 * @category    Omega
 * @package     Database
 * @subpackage  Factory
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class DatabaseFactory implements DatabaseFactoryInterface
{
    /**
     * @inheritdoc
     * 
     * @param ?array $config Holds an optional configuration array that may be used to influence the creation of the object. If no configuration is provided, default settings may be applied.
     * @return mixed Return the created object or value. The return type is flexible, allowing for any type to be returned, depending on the implementation.
     */
    public function create( ?array $config = null ) : DatabaseAdapterInterface
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new AdapterException(
                'Type is not defined.'
            );
        }

        return match( $config[ 'type' ] ) {
            'mysql'  => new MysqlAdapter( $config ),
            'sqlite' => new SqliteAdapter( $config ),
            default  => throw new AdapterException( 'Unrecognised type.' )
        };
    }    
}
