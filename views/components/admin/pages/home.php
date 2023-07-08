<?php

use App\Services\Page;

if ($_SESSION['user_level'] === '100') {

    Page::part('head', 'admin');
    Page::part('sidebar', 'admin');

    $statistic = require_once HOMEDIR . '/config/configStatistic.php';
    $configForum = require_once HOMEDIR . '/config/configForum.php';
    $configGame = require_once HOMEDIR . '/config/configGame.php';
    $directory = HOMEDIR . '/config';
    $permissions = 0644; // Числовое значение прав доступа

    if (is_dir($directory)) {
        // Рекурсивно изменяем права доступа для всех файлов и папок
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        foreach ($iterator as $item) {
            chmod($item, $permissions);
        }
    }
    ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content" class="p-4">
            <?php Page::part('navbar', 'admin'); ?>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Общие
                    </button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Конфигурация
                        форума
                    </button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Конфигурация гейм
                        сервера
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                     tabindex="0">
                    <div class="bg-secondary m-2 p-2 rounded-1">

                        <div class="articles">

                            <form id="form_save_statistic">
                                <div class="content-area flex-ss d-flex p-4 gap-2 flex-wrap justify-content-center">
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Сколько выводить ПвП?</span>
                                        <input style="width: 50px;" value="<?php echo $statistic['game_pvp_count'] ?>"
                                               type="text" class="form-control" name="pvp_stat_count">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Сколько выводить тем с форума? </span>
                                        <input style="width: 50px;"
                                               value="<?php echo $statistic['forum_topic_count'] ?>" type="text"
                                               class="form-control" name="forum_topic_count">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Ссылка на форум </span>
                                        <input style="width: 300px;" value="<?php echo $statistic['forum_link'] ?>"
                                               type="text" class="form-control" name="forum_link">
                                    </div>
                                </div>
                                <button class="btn btn-success w-100" type="submit">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                     tabindex="0">
                    <div class="bg-secondary m-2 p-2 rounded-1">

                        <div class="articles">

                            <form id="form_save_config">
                                <div class="content-area flex-ss d-flex p-4 gap-2 flex-wrap justify-content-center">
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Включить?</span>
                                        <select style="width: 200px" class="form-select"
                                                aria-label="Default select example" name="enable">
                                            <option
                                                value="true" <?php echo $configForum['enable'] === true ? 'selected' : ''; ?>>
                                                Вкл
                                            </option>
                                            <option
                                                value="false" <?php echo $configForum['enable'] === false ? 'selected' : ''; ?>>
                                                Выкл
                                            </option>
                                        </select>

                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Хост </span>
                                        <input style="width: 200px;"
                                               value="<?php echo $configForum['db_host'] ?>" type="text"
                                               class="form-control" name="db_host">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Пользователь </span>
                                        <input style="width: 200px;" value="<?php echo $configForum['db_user'] ?>"
                                               type="text" class="form-control" name="db_user">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Пароль </span>
                                        <input style="width: 200px;" value="<?php echo $configForum['db_pass'] ?>"
                                               type="password" class="form-control" name="db_pass">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Имя базы </span>
                                        <input style="width: 200px;" value="<?php echo $configForum['db_name'] ?>"
                                               type="text" class="form-control" name="db_name">
                                    </div>
                                </div>
                                <button class="btn btn-success w-100" type="submit">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                     tabindex="0">
                    <div class="bg-secondary m-2 p-2 rounded-1">

                        <div class="articles">

                            <form id="form_save_config_game">
                                <div class="content-area flex-ss d-flex p-4 gap-2 flex-wrap justify-content-center">
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Включить?</span>
                                        <select style="width: 200px" class="form-select"
                                                aria-label="Default select example" name="enable">
                                            <option
                                                value="true" <?php echo $configGame['enable'] === true ? 'selected' : ''; ?>>
                                                Вкл
                                            </option>
                                            <option
                                                value="false" <?php echo $configGame['enable'] === false ? 'selected' : ''; ?>>
                                                Выкл
                                            </option>
                                        </select>

                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Хост </span>
                                        <input style="width: 200px;"
                                               value="<?php echo $configGame['db_host'] ?>" type="text"
                                               class="form-control" name="db_host">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Пользователь </span>
                                        <input style="width: 200px;" value="<?php echo $configGame['db_user'] ?>"
                                               type="text" class="form-control" name="db_user">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Пароль </span>
                                        <input style="width: 200px;" value="<?php echo $configGame['db_pass'] ?>"
                                               type="password" class="form-control" name="db_pass">
                                    </div>
                                    <div
                                        class="d-flex align-items-start w-100 align-items-center gap-2 justify-content-between">
                                        <span class="text-white fw-bold">Имя базы </span>
                                        <input style="width: 200px;" value="<?php echo $configGame['db_name'] ?>"
                                               type="text" class="form-control" name="db_name">
                                    </div>
                                </div>
                                <button class="btn btn-success w-100" type="submit">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab"
                     tabindex="0">...
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright <?php echo $_SERVER['HTTP_HOST'] ?> 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    <?php Page::part('footer', 'admin'); ?>
<?php } ?>