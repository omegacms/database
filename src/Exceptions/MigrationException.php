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
use PDOException;

/**
 * Migration exception class.
 *
 * The `MigrationException` thrown for migration-related errors.
 * This exception is a subclass of PDOException and is used to
 * represent errors that occur specifically in the context of
 * database migrations.
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
class MigrationException extends PDOException
{
}
