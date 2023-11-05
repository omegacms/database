<?php
/**
 * Part of Banco Omega CMS -  Database Package
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
 * Integer field class.
 *
 * @category    Omega
 * @package     Framework\Database
 * @subpackage  Omega\Database\Migration\Field
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class IntField extends AbstractField
{
    /**
     * Default value.
     *
     * @var ?int $default Holds the default value or null.
     */
    public ?int $default = null;

    /**
     * Set the default value for field.
     *
     * @param  int $value Holds the field value.
     * @return $this
     */
    public function default( int $value ) : static
    {
        $this->default = $value;

        return $this;
    }
}