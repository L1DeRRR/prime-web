<?php

namespace App\Services;

class Router
{
    private static $list = [];

    public static function page($url, $page_name, $type)
    {
        self::$list[] = [
            "url" => $url,
            "page" => $page_name,
            "type" => $type
        ];
    }

    public static function post($url, $class, $method, $formdata = false, $files = false)
    {
        self::$list[] = [
            "url" => $url,
            "class" => $class,
            "method" => $method,
            "post" => true,
            "formdata" => $formdata,
            "files" => $files
        ];
    }

    public static function enable()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {
            $query = isset($_GET['q']) ? $_GET['q'] : (isset($_POST['q']) ? $_POST['q'] : '');

            foreach (self::$list as $route) {
                if ($route["url"] === '/' . $query) {
                    if (isset($route['post']) && $route['post'] === true && $_SERVER['REQUEST_METHOD'] === 'POST') {
                        $action = new $route['class'];
                        $method = $route['method'];

                        if ($route['formdata'] && $route['files']) {
                            // Проверяем наличие загруженного файла
                            if (isset($_FILES[$route['file']]) && $_FILES[$route['file']]['error'] === UPLOAD_ERR_OK) {
                                $fileTmpPath = $_FILES[$route['file']]['tmp_name'];
                                $fileName = $_FILES[$route['file']]['name'];
                                $targetPath = '/path/to/upload/directory/' . $fileName;
                                move_uploaded_file($fileTmpPath, $targetPath);
                                // Добавьте имя файла в $_POST, если требуется
                                $_POST[$route['file']] = $fileName;
                            }

                            $action->$method($_POST, $_FILES);
                        } elseif ($route['formdata'] && !$route['files']) {
                            $action->$method($_POST);
                        } else {
                            $action->$method();
                        }

                        die();
                    } else {
                        if ($route["type"] === 'page') {
                            require_once 'views/pages/' . $route['page'] . '.php';
                            die();
                        }
                        if ($route["type"] === 'admin') {
                            require_once 'views/components/admin/pages/' . $route['page'] . '.php';
                            die();
                        }
                        if ($route["type"] === 'install') {
                            require_once 'install/' . $route['page'] . '.php';
                            die();
                        }
                    }
                }
            }
        }

        self::error('404');
    }

    public static function error($error)
    {
        require_once 'views/errors/' . $error . '.php';
    }
}
