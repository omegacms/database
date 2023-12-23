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
 * Abstract migration class.
 *
 * The `AbstractMigration` class provides a foundation for creating database
 * migrations with various field types.
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
abstract class AbstractMigration implements MigrationInterface
{
    /**
     * Fields array.
     *
     * @var array $fields Holds an array of fields.
     */
    protected array $fields = [];

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return BoolField Return an instance of BoolField.
     */
    public function bool( string $name ) : BoolField
    {
        return $this->fields[] = new BoolField( $name );
    }

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return DateTimeField Return an instance of DateTimeField.
     */
    public function dateTime( string $name ) : DateTimeField
    {
        return $this->fields[] = new DateTimeField( $name );
    }

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return FloatField Return an instance of FloatField.
     */
    public function float( string $name ) : FloatField
    {
        return $this->fields[] = new FloatField( $name );
    }

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return IdField Return an instance of IdField.
     */
    public function id( string $name ) : IdField
    {
        return $this->fields[] = new IdField( $name );
    }

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return IntField Return an instance of IntField.
     */
    public function int( string $name ) : IntField
    {
        return $this->fields[] = new IntField( $name );
    }

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return StringField Return an instance of StringField.
     */
    public function string( string $name ) : StringField
    {
        return $this->fields[] = new StringField( $name );
    }

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the field name.
     * @return TextField Return an instance of TextField.
     */
    public function text( string $name ) : TextField
    {
        return $this->fields[] = new TextField( $name );
    }

    /**
     * inheritdoc
     *
     * @return void
     */
    abstract public function execute() : void;

    /**
     * @inheritdoc
     *
     * @param  string $name Holds the column name.
     * @return $this
     */
    abstract public function dropColumn( string $name ) : static;
}
