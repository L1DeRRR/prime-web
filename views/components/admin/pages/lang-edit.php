<?php

use App\Services\Page;
use App\News\News;
use App\User\User;
use Symfony\Component\Yaml\Yaml;
use App\Controllers\Auth;


if ($_SESSION['user_level'] === '100') :
    $userHelper = new User();
    $newsHelper = new News();
    $myNews = $newsHelper->getNews();

    Page::part('head', 'admin');
    Page::part('sidebar', 'admin');

// Определите путь к языковым файлам
    $languagesDir = HOMEDIR . '/lang/';

// Получите список доступных языковых файлов
    $languages = scandir($languagesDir);
    $languages = array_diff($languages, ['.', '..']);


    $selectedLanguageUrl = new Auth();
    $selectedLanguage = $selectedLanguageUrl->langUrl();

// Загрузите содержимое выбранного языкового файла
    $filePath = $languagesDir . '/' . $selectedLanguage;
    $translations = Yaml::parseFile($filePath);


    ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">
            <?php Page::part('navbar', 'admin'); ?>
            <div class="p-3 text-white">
                <div class="m-auto w-100 p-5">
                    <h5 class="bg-dark text-center text-white p-2 rounded-1">Редактирование языков</h5>

                    <form id="lang_edit">
                        <textarea id="translations" rows="10" cols="50" class="form-control" name="translations"
                                  rows="10" cols="50"><?php echo Yaml::dump($translations, 10, 2); ?></textarea>
                        <br>
                        <input type="hidden" name="lang_url" value="<?php echo $selectedLanguage ?>">
                        <input type="submit" value="Сохранить" class="btn btn-success w-100 mb-2">
                    </form>
                    <div class="bg-secondary p-3 w-100">
                        <h4 class="text-white text-center">Доступные языковые файлы:</h4>
                        <ul class="list-unstyled">
                            <?php foreach ($languages as $language): ?>
                                <li>
                                    <a class="mb-2 text-decoration-none text-white fw-bolds btn-link btn btn-danger d-block bg-dark"
                                       href="?<?php echo $language; ?>"><?php
                                        if ($language == 'ru.yaml') {
                                            echo 'Русский';
                                        } elseif ($language == 'uk.yaml') {
                                            echo 'Українська';
                                        } elseif ($language == 'en.yaml') {
                                            echo 'English';
                                        }

                                        ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
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

    <?php Page::part('footer', 'admin'); ?>

<?php else: ?>
    <?php exit(); ?>
<?php endif; ?>