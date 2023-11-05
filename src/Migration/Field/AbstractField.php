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
 * Abstract field class.
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
abstract class AbstractField implements FieldInterface
{
    /**
     * Field name.
     *
     * @var string $name Holds the field name.
     */
    public string $name;

    /**
     * Nullable field.
     *
     * @var bool $nullable Determine if field is nullable.
     */
    public bool $nullable = false;

    /**
     * Alterable field.
     *
     * @var bool $alter Determine if field is alterable.
     */
    public bool $alter = false;

    /**
     * AbstractField class constructor.
     *
     * @param  string $name Holds the field name.
     * @return void
     */
    public function __construct( string $name )
    {
        $this->name = $name;
    }

    /**
     * Determine if the field is nullable.
     *
     * @return $this
     */
    public function nullable() : static
    {
        $this->nullable = true;

        return $this;
    }

    /**
     * Determine if the field is alterable.
     *
     * @return $this
     */
    public function alter() : static
    {
        $this->alter = true;

        return $this;
    }
}