<?php

namespace LaravelPdoOdbc;

use Illuminate\Database\Connection;
use LaravelPdoOdbc\Database\Query\Grammars\LeanQueryGrammar;
use LaravelPdoOdbc\Database\Query\Processors\LeanProcessor;
use LaravelPdoOdbc\Database\Schema\Grammars\LeanSchemaGrammar;
use LaravelPdoOdbc\Database\Schema\LeanBuilder;

class ODBCConnection extends Connection
{

    public function getDefaultQueryGrammar()
    {
        return new LeanQueryGrammar();
    }

    public function getSchemaGrammar()
    {
        return $this->getDefaultSchemaGrammar();
    }

    public function getDefaultSchemaGrammar()
    {
        return new LeanSchemaGrammar();
    }

    /**
     * Get current fetch mode from the connection.
     * Default should be: PDO::FETCH_OBJ.
     */
    public function getFetchMode(): int
    {
        return $this->fetchMode;
    }

    /**
     * Get the default post processor instance.
     *
     */
    protected function getDefaultPostProcessor()
    {
        return new LeanProcessor();
    }

    /**
     * Get a schema builder instance for the connection.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    public function getSchemaBuilder()
    {
        return new LeanBuilder($this);
    }

    /**
     * Get the name of the connected database.
     * Lean using uppercase database names.
     * @return string
     */
    public function getDatabaseName()
    {
        return strtoupper($this->database);
    }

    /**
     * Set the name of the connected database.
     * Lean using uppercase database names
     *
     * @param  string  $database
     * @return $this
     */
    public function setDatabaseName($database)
    {
        $this->database = strtoupper($database);

        return $this;
    }
}
