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
namespace Omega\Database\Migration\Field;

/**
 * @use
 */
use Omega\Database\Exceptions\MigrationException;

/**
 * ID field class.
 *
 * The `IdField` epresents a string field for database migrations.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\Migration\Field
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class IdField extends AbstractField
{
    /**
     * Set the default value for float field.
     *
     * @param  bool $value Holds the default value for the id field.
     * @return $this Returns the current instance for method chaining.
     */
    public function default() : mixed
    {
        throw new MigrationException(
            'ID fields cannot have a default value'
        );
    }
}
