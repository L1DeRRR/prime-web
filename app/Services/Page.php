<?php

namespace App\Services;

class Page
{
    public static function part($part_name, $type = null)
    {
        if ($type == 'admin') {
            require_once 'views/components/admin/' . $part_name . '.php';
        } else {
            require_once 'views/components/' . $part_name . '.php';
        }
    }

    public static function connect($part_name)
    {
        require_once 'views/components/admin/pages/' . $part_name . '.php';
    }
}