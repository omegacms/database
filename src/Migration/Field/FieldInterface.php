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
 * Field interface.
 *
 * Thie `FieldInterface` defines the contract for database migration field classes,
 * providing methods to determine if the field is nullable or alterable.
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
interface FieldInterface
{
    /**
     * Determine if the field is nullable.
     *
     * @return $this
     */
    public function nullable() : static;

    /**
     * Determine if the field is alterable.
     *
     * @return $this
     */
    public function alter() : static;
}
