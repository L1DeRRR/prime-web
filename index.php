<?php
session_start();
use App\Services\App;
define('HOMEDIR', __DIR__);

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    define('HOSTNAME', 'https://' . $_SERVER['HTTP_HOST']);
} else {
    define('HOSTNAME', 'http://' . $_SERVER['HTTP_HOST']);
}

define('VIEWSDIR', HOSTNAME . '/views/');
define('ASSETSDIR', HOSTNAME . '/views/assets/');


require_once __DIR__ . "/vendor/autoload.php";
App::start();

require_once __DIR__ . "/route/routes.php";
