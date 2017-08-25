<?php

namespace App\Libraries;

use DB;

class Setting
{
    public static function get($key, $default = '')
    {
        $record = DB::table('setting')->where('key', $key)->first();
        if (is_null($record)) {
            return $default;
        }
        return $record->value;
    }

    public static function set($key, $val)
    {
        $record = DB::table('setting')->where('key', $key)->first();
        if (is_null($record)) {
            DB::table('setting')->insert([
                'key' => $key,
                'value' => $val
              ]);
        } else {
            DB::table('setting')
              ->where('key', $key)
              ->update([
                  'value' => $val
              ]);
        }
    }
}
