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
 * Float field class.
 *
 * The `FloatField` represents a string field for database migrations.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\Migration\Field
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class FloatField extends AbstractField
{
    /**
     * Default value for the float field.
     *
     * @var ?string $default Holds the default value or null.
     */
    public ?float $default = null;

    /**
     * Set the default value for float field.
     *
     * @param  bool $value Holds the default value for the float field.
     * @return $this Returns the current instance for method chaining.
     */
    public function default( float $value ) : static
    {
        $this->default = $value;

        return $this;
    }
}
