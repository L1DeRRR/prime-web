<?php

namespace App\User;

use App\Controllers\Auth;


class User
{
    private $login;
    private $id;
    private $email;
    private $password;
    private $name;

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setName($name)
    {
        $this->login = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUserById()
    {
        $id = $_SESSION['user_id'];
        session_start();
        $table = Auth::$tableName['users'];
        $userName = \R::findOne($table, 'id = ?', [$id]);
        return $userName;
    }

    public function getUserLanguages()
    {
        $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $preferredLanguages = array_map(function ($language) {
            $parts = explode(';', $language);
            $locale = $parts[0];
            $quality = isset($parts[1]) ? (float)explode('=', $parts[1])[1] : 1.0;
            return [
                'locale' => $locale,
                'quality' => $quality
            ];
        }, explode(',', $acceptLanguage));

        usort($preferredLanguages, function ($a, $b) {
            return $b['quality'] <=> $a['quality'];
        });

        $preferredLanguage = $preferredLanguages[0]['locale'];

        // Получение двухбуквенного кода языка
        $languageCode = substr($preferredLanguage, 0, 2);

        return $languageCode;
    }

    public function getUrlPath() {
        $url = $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', rtrim($path, '/'));
        $lastSegment = end($segments);

        if ($lastSegment === 'ru') {
            header('Location: /');
            return 'ru';
        } elseif ($lastSegment === 'en') {
            return 'en';
        } elseif ($lastSegment === 'uk') {
            return 'uk';
        } else {
            return 'ru';
        }
    }


}
