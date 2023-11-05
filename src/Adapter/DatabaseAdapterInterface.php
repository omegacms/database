<?php

namespace Omega\Database\Adapter;

use Omega\Database\Migration\AbstractMigration;
use Omega\QueryBuilder\AbstractQueryBuilder;
use Pdo;

interface DatabaseAdapterInterface
{
    /**
     * Get the underlying Pdo instance for this connection
     */
    public function pdo() : Pdo;

    /**
     * Start a new query on this connection
     */
    public function query() : AbstractQueryBuilder;

    /**
     * Start a new migration to add a table on this connection
     */
    public function createTable( string $table ) : AbstractMigration;

    /**
     * Start a new migration to add a table on this connection
     */
    public function alterTable( string $table ) : AbstractMigration;

    /**
     * Return a  list of table names on this connection
     */
    public function getTables() : array;

    /**
     * Find out if a table exists on this connection
     */
    public function hasTable( string $name ) : bool;

    /**
     * Drop all tables in the current database
     */
    public function dropTables() : int;
}