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
namespace Omega\Database\Exceptions;

/**
 * @use
 */
use InvalidArgumentException;

/**
 * Connection exception class.
 *
 * The `ConnectionException` thrown for improperly configured database connections.
 * This exception is a subclass of InvalidArgumentException and is used to represent
 * errors that occur when a database connection is not properly configured.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\Exceptions
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class ConnectionException extends InvalidArgumentException
{
}
