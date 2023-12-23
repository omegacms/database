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
namespace Omega\Database\Migration;

/**
 * @use
 */
use Omega\Database\Migration\Field\BoolField;
use Omega\Database\Migration\Field\DateTimeField;
use Omega\Database\Migration\Field\FloatField;
use Omega\Database\Migration\Field\IdField;
use Omega\Database\Migration\Field\IntField;
use Omega\Database\Migration\Field\StringField;
use Omega\Database\Migration\Field\TextField;

/**
 * Migration interface.
 *
 * The `MigrationInterface` defines methods for specifying fields and
 * executing migrations on a database.
 *
 * @category    Omega
 * @package     Omega\Database
 * @subpackage  Omega\Database\Migration
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
interface MigrationInterface
{
    /**
     * Set the boolean field.
     *
     * @param  string $name Holds the field name.
     * @return BoolField Return an instance of BoolField.
     */
    public function bool( string $name ) : BoolField;

    /**
     * Set DateTime field.
     *
     * @param  string $name Holds the field name.
     * @return DateTimeField Return an instance of DateTimeField.
     */
    public function dateTime( string $name ) : DateTimeField;

    /**
     * Set the float field.
     *
     * @param  string $name Holds the field name.
     * @return FloatField Return an instance of FloatField.
     */
    public function float( string $name ) : FloatField;

    /**
     * Set the id field.
     *
     * @param  string $name Holds the field name.
     * @return IdField Return an instance of IdField.
     */
    public function id( string $name ) : IdField;

    /**
     * Set the integer field.
     *
     * @param  string $name Holds the field name.
     * @return IntField Return an instance of IntField.
     */
    public function int( string $name ) : IntField;

    /**
     * Set the string field.
     *
     * @param  string $name Holds the field name.
     * @return StringField Return an instance of StringField.
     */
    public function string( string $name ) : StringField;

    /**
     * Set the text field.
     *
     * @param  string $name Holds the field name.
     * @return TextField Return an instance of TextField.
     */
    public function text( string $name ) : TextField;

    /**
     * Execute migration.
     *
     * @return void
     */
    public function execute() : void;

    /**
     * Drop column.
     *
     * @param  string $name Holds the column name.
     * @return $this
     */
    public function dropColumn( string $name ) : static;
}
