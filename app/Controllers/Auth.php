<?php

namespace App\Controllers;

use App\User\User;
use \R;
use Symfony\Component\Yaml\Yaml;


class Auth
{
    private $userProfile;
    private $user;

    public static $tableName = [
        "users" => "users",
        "news" => "news",
    ];

    public function __construct()
    {
        $this->user = new User();
    }

    //Обработка регистрации
    public function register($data)
    {
        if (self::checkTableExists(self::$tableName['users'])) {

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($data) && !empty($data['login']) && !empty($data['password']) && !empty($data['password_confirm']) && !empty($data['email']) && !empty($data['name'])) {
                    $my_table = self::$tableName['users'];

                    $user = $this->user;
                    $user->setLogin($data['login']);
                    $user->setPassword($data['password']);
                    $user->setEmail($data['email']);
                    $user->setName($data['name']);

                    $password_confirm = $data['password_confirm'];

                    if ($user->getPassword() === $password_confirm) {
                        if (strlen($user->getPassword()) >= 6) {
                            if (strlen($user->getLogin()) >= 6) {
                                if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {

                                    $userCheck = \R::findOne($my_table, 'login = ?', [$user->getLogin()]);

                                    if ($userCheck) {
                                        self::response('error', 'Користувач із таким логіном вже існує.');
                                    } else {
                                        $users = R::dispense($my_table);
                                        $users->login = $user->getLogin();
                                        $users->password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                                        $users->email = $user->getEmail();
                                        $users->name = $user->getName();

                                        $id = \R::store($users);
                                        if ($id !== 0) {
                                            self::response('redirect', 'Реєстрація пройшла успішно!', '/login', '500', 'success');
                                        } else {
                                            self::response('error', 'Помилка при збереженні даних.');
                                        }
                                        R::close();
                                    }
                                } else {
                                    self::response('warning', 'Неправильний формат електронної адреси.');
                                }
                            } else {
                                self::response('warning', 'Довжина логіну не менше 6 символів');
                            }
                        } else {
                            self::response('warning', 'Довжина пароля не менше 6 символів');
                        }
                    } else {
                        self::response('warning', 'Паролі не співпадають.');
                    }
                } else {
                    self::response('error', 'Поля не можуть бути порожніми.');
                }
            }
        } else {
            self::response('error', 'Стовпець ' . self::$tableName['users'] . ' не існує.');
        }
    }


    public function login($data)
    {
        if (self::checkTableExists(self::$tableName['users'])) {
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($data) && !empty($data['login']) && !empty($data['password'])) {
                    $my_table = self::$tableName['users'];
                    $user = $this->user;

                    $user->setLogin($data['login']);
                    $user->setPassword($data['password']);

                    $login = $user->getLogin();
                    $password = $user->getPassword();

                    $users = \R::findOne($my_table, 'login = ?', [$login]);

                    if ($users) {
                        $hashedPassword = $users->password;
                        if (password_verify($password, $hashedPassword)) {

                            $_SESSION['user_id'] = $users->id;
                            $_SESSION['user_level'] = $users->acces_level;


                            self::response('redirect', 'Ви успішно авторизувались!', '/dashboard', '500', 'success');
                        } else {
                            self::response('error', 'Невірний пароль.');
                        }
                    } else {
                        self::response('error', 'Невірний логін.');
                    }

                    R::close();
                } else {
                    self::response('error', 'Поля не можуть бути порожніми.');
                }
            }
        } else {
            self::response('error', 'Таблицы ' . self::$tableName['users'] . ' не существует.');
        }
    }


    public function updateConfig($configData, $type = null)
    {
        $configFilePath = '';
        if ($type == 'statistic') {
            $configFilePath = HOMEDIR . '/config/configStatistic.php';
        } elseif ($type == 'forum') {
            $configFilePath = HOMEDIR . '/config/configForum.php';
        } elseif ($type == 'game') {
            $configFilePath = HOMEDIR . '/config/configGame.php';
        }elseif ($type == 'db') {
            $configFilePath = HOMEDIR . '/config/configDB.php';
        }

        // Преобразование данных конфигурации в строку формата PHP
        $configContent = "<?php\n\nreturn " . var_export($configData, true) . ";\n";

        // Запись данных в файл конфигурации
        if (file_put_contents($configFilePath, $configContent) !== false) {
            self::response('redirect', 'Успешно сохранено.', '/admin', '500', 'success');
        } else {
            self::response('error', 'Ошибка при сохранении.');
        }
    }


    public function saveStatistic($data)
    {
        if (isset($data) && !empty($data['pvp_stat_count'])) {
            $pvpStatCount = $data['pvp_stat_count'];
            $forumTopicCount = $data['forum_topic_count'];
            $forumLink = $data['forum_link'];

            $configData = [
                'game_pvp_count' => $pvpStatCount,
                'forum_topic_count' => $forumTopicCount,
                'forum_link' => $forumLink,
            ];

            $this->updateConfig($configData, 'statistic');
        }
    }

    public function saveConfig($data)
    {
        if (isset($data) && !empty($data['enable'])) {
            $enable = filter_var($data['enable'], FILTER_VALIDATE_BOOL);
            $db_host = $data['db_host'];
            $db_user = $data['db_user'];
            $db_pass = $data['db_pass'];
            $db_name = $data['db_name'];

            $configData = [
                "enable" => $enable,
                "db_host" => $db_host,
                "db_user" => $db_user,
                "db_pass" => $db_pass,
                "db_name" => $db_name,
            ];

            $result = $this->updateConfig($configData, 'forum');

            if ($result['status'] === 'success') {
                self::response('redirect', 'Успешно сохранено.', '/admin', '500', 'success');
            }
        }

        self::response('error', 'Ошибка при сохранении.');
    }

    public function saveConfigGame($data)
    {
        if (isset($data) && !empty($data['enable'])) {
            $enable = filter_var($data['enable'], FILTER_VALIDATE_BOOL);
            $db_host = $data['db_host'];
            $db_user = $data['db_user'];
            $db_pass = $data['db_pass'];
            $db_name = $data['db_name'];

            $configData = [
                "enable" => $enable,
                "db_host" => $db_host,
                "db_user" => $db_user,
                "db_pass" => $db_pass,
                "db_name" => $db_name,
            ];

            $result = $this->updateConfig($configData, 'game');

            if ($result['status'] === 'success') {
                self::response('redirect', 'Успешно сохранено.', '/admin', '500', 'success');
            }
        }

        self::response('error', 'Ошибка при сохранении.');
    }
    public function langUrl() {
        $url = $_SERVER['REQUEST_URI'];
        $queryString = parse_url($url, PHP_URL_QUERY);
        $selectedLanguage = $queryString ? $queryString : 'ru.yaml';
        return $selectedLanguage;
    }

    public function editLang($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($data['translations'])) {

                // Определите путь к языковым файлам
                $languagesDir = HOMEDIR . '/lang';

                $languages = scandir($languagesDir);
                $languages = array_diff($languages, ['.', '..']);

                $selectedLanguage = $data['lang_url'];

                $filePath = $languagesDir . '/' . $selectedLanguage;
                $updatedTranslations = $data['translations'];

                // Замените символы перевода строки на только `\n`
                $updatedTranslations = str_replace("\r\n", "\n", $updatedTranslations);

                // Разделите переводы на строки
                $translationLines = explode("\n", $updatedTranslations);

                // Создайте ассоциативный массив переводов
                $translations = [];
                foreach ($translationLines as $line) {
                    $parts = explode(':', $line, 2);
                    if (count($parts) === 2) {
                        $key = trim($parts[0]);
                        $value = trim($parts[1]);

                        // Проверка на многострочное значение
                        if (strpos($value, "\n") !== false) {
                            $value = Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK . $value;
                        }

                        // Удалите лишние одинарные кавычки
                        $value = str_replace("'", "", $value);

                        $translations[$key] = $value;
                    }
                }

                $yamlContent = Yaml::dump($translations, 10, 2);

                // Сохраните изменения в языковом файле
                file_put_contents($filePath, $yamlContent);

                self::response('redirect', 'Успешно Сохранено','/admin/lang?' . $data['lang_url'],'500','success');
            }
        }
    }

// проверка таблицы
    function checkTableExists($tableName)
    {
        $tables = R::inspect();

        if (in_array($tableName, $tables)) {
            // Таблица существует
            return true;
        } else {
            // Таблица не существует
            return false;
        }
    }

    // Вывод JSON-ответа
    public
    function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

// Формирование JSON-ответа
    public
    function response($type, $message = '', $redirect_url = null, $redirect_time = null, $redirect_type = null)
    {
        if ($type === 'error') {
            $response = [
                'criticalError' => htmlspecialchars($message)
            ];
        } elseif ($type === 'success') {
            $response = [
                'success' => htmlspecialchars($message)
            ];
        } elseif ($type === 'warning') {
            $response = [
                'warning' => htmlspecialchars($message)
            ];
        } elseif ($type === 'redirect') {
            $response = [
                'redirect' => htmlspecialchars($redirect_url),
                'redirect_time' => htmlspecialchars($redirect_time),
                'messageRedirect' => htmlspecialchars($message),
                'redirect_type' => htmlspecialchars($redirect_type),
            ];

        }
        $this->sendJsonResponse($response);
    }

    public function checkTableData($tableName)
    {
        $count = \R::count($tableName); // Подсчет количества записей в таблице

        if ($count > 0) {
            return true; // В таблице есть данные
        } else {
            return false; // Таблица пуста
        }
    }

}