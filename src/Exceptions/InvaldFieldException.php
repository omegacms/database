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
 * Invalid field exception class.
 *
 * The `InvalidFieldException` class is a custom exception used to indicate errors related to invalid
 * fields  during validation  processes. It extends the InvalidArgumentException  class, allowing for
 * specific handling of field validation  errors.  When thrown, this  exception signals  that a field
 * does not  meet the  required criteria  or is otherwise  invalid according to the validation rules.
 * This exception  can  be caught and  processed within the  application to provide appropriate error
 * handling and feedback to users or developers.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\Exceptions
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class InvalidFieldException extends InvalidArgumentException
{
}