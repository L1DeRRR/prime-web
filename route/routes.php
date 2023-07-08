<?php 
use App\Services\Router;
use App\Controllers\Auth;
use App\News\News;

$newsHelper = new News();
$myNews = $newsHelper->getNews();

//pages
Router::page('/', 'home','page');
Router::page('/ru', 'home','page');
Router::page('/en', 'home','page');
Router::page('/uk', 'home','page');
Router::page('/admin', 'dashboard','page');
Router::page('/admin/news', 'news','admin');
Router::page('/admin/lang', 'lang-edit','admin');
foreach ($myNews as $news) {
    Router::page('/full/' . $news->id, 'full-news','page');
}





Router::post('/auth/login', Auth::class, 'login', true, false);
Router::post('/auth/register', Auth::class, 'register', true, false);
Router::post('/news/remove', News::class, 'removeNewsById', true, false);
Router::post('/statistic/save', Auth::class, 'saveStatistic', true, false);
Router::post('/config/save', Auth::class, 'saveConfig', true, false);
Router::post('/config/save/game', Auth::class, 'saveConfigGame', true, false);
Router::post('/lang/edit', Auth::class, 'editLang', true, false);
Router::enable();

