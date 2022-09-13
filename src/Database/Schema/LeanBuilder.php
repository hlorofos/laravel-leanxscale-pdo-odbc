<?php

namespace LaravelPdoOdbc\Database\Schema;

use Illuminate\Database\Schema\MySqlBuilder;

class LeanBuilder extends MySqlBuilder
{
    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function hasTable($table)
    {
        $table = $this->connection->getTablePrefix().$table;

        return count($this->connection->select(
                $this->grammar->compileTableExists(), [$this->connection->getDatabaseName(), strtoupper($table)]
            )) > 0;
    }

    /**
     * Drop all tables from the database.
     *
     * @return void
     */
    public function dropAllTables()
    {
        $tables = [];

        foreach ($this->getAllTables() as $row) {
            $row = (array) $row;

            $tables[] = reset($row);
        }

        if (empty($tables)) {
            return;
        }

        // Lean doesn't support multiple tables in drop table statement.
        foreach ($this->grammar->wrapArray($tables) as $table) {
            $this->connection->statement("drop table $table");
        }
    }

    /**
     * Get all of the table names for the database.
     *
     * @return array
     */
    public function getAllTables()
    {
        return $this->connection->select(
            $this->grammar->compileGetAllTables($this->connection->getDatabaseName())
        );
    }
}
