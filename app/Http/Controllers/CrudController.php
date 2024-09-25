<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrudController extends Controller
{
    public function getTable()
    {

        $data['tables'] = collect(DB::select('SHOW TABLES'))->whereNotIn('Tables_in_test', config('crd.unwanted_tables', []))->pluck('Tables_in_test')->toArray();

        $data['columns'] = DB::select("
            SELECT 
                C.COLUMN_NAME, 
                C.DATA_TYPE, 
                C.COLUMN_TYPE, 
                C.CHARACTER_MAXIMUM_LENGTH, 
                C.IS_NULLABLE, 
                C.COLUMN_KEY, 
                C.COLUMN_DEFAULT, 
                C.EXTRA,
                K.REFERENCED_TABLE_NAME, 
                K.REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS C
            LEFT JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE K
            ON C.TABLE_NAME = K.TABLE_NAME 
            AND C.COLUMN_NAME = K.COLUMN_NAME 
            AND C.TABLE_SCHEMA = K.TABLE_SCHEMA
            WHERE C.TABLE_NAME = 'users'
            AND C.TABLE_SCHEMA = DATABASE()
            ORDER BY C.ORDINAL_POSITION
        ");

        return view('test', $data);
    }
}
