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
namespace Omega\Database;

/**
 * TableName class.
 *
 * @category    Omega
 * @package     Omega\Database
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class TableName
{
    /**
     * Table name.
     *
     * @var string $name Holds the table name.
     */
    public string $name;

    /**
     * TableName class constructor.
     *
     * @param  string $name Holds the table name.
     * @return void
     */
    public function __construct( string $name )
    {
        $this->name = $name;
    }
}
