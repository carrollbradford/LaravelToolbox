<?php

namespace Carrollbradford\Toolbox\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
* Tiny function related to DB attributes or features
* @package Toolbox\Helpers
*/

class DBHelper
{
    /**
    * Collect the values directly from the db field
    *
    * @param String $table Name
    * @param String $column Name
    * @return Array
    */
    public static function getEnum(string $table, string $column): array
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = [];

        if (!empty($matches)) {
            foreach (explode(',', $matches[1]) as $value) {
                $v = trim($value, "'");
                $enum = Arr::add($enum, $v, $v);
            }
        }
        //add key #'s
        return array_values($enum);
    }
    

    /**
    * Get a tables column name
    * @param string $table
    * @return array
    */
    /**
    * Test if a table has a column(s)
    *
    * @param string $table Name
    * @param array $columns Array with column names
    * @return bool
    */
    public static function hasColumns(string $table, array $columns): bool
    {
        return DB::getSchemaBuilder()->hasColumns($table, $columns);
    }
    

    /**
    * Array with existing columns for a table
    *
    * @param string $table Name
    * @return array
    */
    public static function getTableColumns(string $table): array
    {
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        return [
            'db' => $columns,
            'request' => collect($columns)->map(function ($name) {
                return Str::camel($name);
            })->all(),
            'detailed' => DB::select(DB::raw("SHOW COLUMNS FROM $table")),
        ];
    }
    

    /**
    * Dynamically convert the keys to correct column equivalents
    * @param array|collection|object $request Collection
    * @return array
    */
    public static function keysToDbFormat($request): array
    {
        // Parse the request to fit the colums and easy match
        return collect($request)->mapWithKeys(function ($item, $key) {
            $key = Str::snake($key);
            return [$key => $item];
        })->all();
    }


    /**
    * Dynamically convert the keys to correct column equivalents
    * @param array|collection|object $request Collection
    * @return array|object To match what the original Collection was.
    */
    public static function keysToUserFormat($request)
    {
        // Parse the request to fit the colums and easy match
        $collection = collect($request)->mapWithKeys(function ($item, $key) {
            $key = Str::camel($key);
            if (is_array($item) || is_object($item)) {
                $item = self::keysToUserFormat($item);
            }
            return [$key => $item];
        })->all();

        return (gettype($request) === 'object' ? (object) $collection : $collection);
    }


    /**
    * Translate filters to Laravel Array of Filters
    * And converts the "key" to Database format snake_case
    * @param array $filters
    * @example [key:value] or [key:[operator,value]]
    * @return array|Exception Array of Arrays as per Laravel filters for "where".
    * @throws Exception If not a valid array.
    */
    public static function setFilters(array $filters): array
    {
        if (!empty($filters) && Arr::isAssoc($filters)) {
            $filtersBag = [];
            $filters = self::keysToDbFormat($filters);

            foreach ($filters as $key => $value) {
                if (is_array($value) && !empty(($value[0] && $value[1]))) {
                    $filter = [$key, $value[0], $value[1]];
                } else {
                    $filter = [$key, $value];
                }
                array_push($filtersBag, $filter);
            }
            
            return $filtersBag;
        } else {
            throw new \Exception('Filters must be a Simple Associative Array Key:pair Values');
        }
    }
}
