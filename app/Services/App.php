<?php

namespace App\Services;


class App
{

    public static function start()
    {
        self::libs();
        self::db();
    }

    public static function libs()
    {
        $config = require_once "config/app.php";

        foreach ($config['libs'] as $lib) {
            require_once "libs/" . $lib . '.php';
        }
    }

    public static function db()
    {
        $config = require_once HOMEDIR . "/config/configDB.php";
        if ($config['enable']) {
            \R::setup(
                'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
                $config['db_user'],
                $config['db_pass']
            );
        }
        if (!\R::testConnection()) {
            die('error');
        }
    }


    public function createTableIfNotExists($tableName, $columns)
    {
        // Проверяем существование таблицы
        $tableExists = \R::inspect($tableName);

        // Если таблицы не существует, создаем ее
        if (!$tableExists) {
            \R::freeze(true);
            \R::begin();
            try {
                // Создание таблицы с указанными столбцами
                $table = \R::dispense($tableName);
                foreach ($columns as $column) {
                    $table->unbox()->setAttr($column);
                }
                \R::store($table);
                \R::commit();
            } catch (Exception $e) {
                \R::rollback();
                throw $e;
            }
            \R::freeze(false);
        }
    }


}
