<?php
session_start();
use App\Services\Page;
use App\News\News;
use App\User\User;
$getLang = new User();
$newsHelper = new News();
if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    // Иначе, используем язык по умолчанию (например, 'ru')
    $lang = $getLang->getUserLanguages();

    // Сохраняем язык в сессии
    $_SESSION['lang'] = $lang;
}

$LangUrl = $getLang->getUrlPath();

$useLangName = $lang;
$getLangName = $useLangName ? $useLangName : $getLang->getUserLanguages();
$langNews = 'news_' . $useLangName;


$getId = $newsHelper->getNewsUrl('id');
$myNews = $newsHelper->getNewsById($getId);

Page::part('head');
Page::part('header');

?>


<div class="articles">
    <div class="articles__item-title mb-4">
        <p class="text-center"><?php echo $myNews->title ?></p>
    </div>
    <div class="content-area flex-ss">
        <article class="articles__items m-auto h-auto p-2 bg-light w-50 rounded-1">
            <div class="articles__item-full overflow-auto">
                <p class="text-center fw-bold"><?php echo $myNews->$langNews ?></p>
            </div>
        </article>

    </div>
</div>


<?php Page::part('footer'); ?>
