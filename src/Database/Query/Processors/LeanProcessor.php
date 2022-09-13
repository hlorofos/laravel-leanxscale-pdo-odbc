<?php

namespace LaravelPdoOdbc\Database\Query\Processors;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Processors\Processor;

class LeanProcessor extends Processor
{
    /**
     * Process an  "insert get ID" query.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string  $sql
     * @param  array  $values
     * @param  string|null  $sequence
     * @return int
     */
    public function processInsertGetId(Builder $query, $sql, $values, $sequence = null)
    {
        $result = $query->getConnection()->select($sql, $values);
        $id = is_array($result) && isset($result[0]->result) ? $result[0]->result : null;

        return is_numeric($id) ? (int) $id : $id;
    }
}
