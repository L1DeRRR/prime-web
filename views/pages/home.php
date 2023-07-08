<?php
$myStatistic = require_once HOMEDIR . '/config/configStatistic.php';
$pvpStatCount = $myStatistic['game_pvp_count'];
$forumTopicCount = $myStatistic['forum_topic_count'];
$forumLink = $myStatistic['forum_link'];

use App\Services\Page;
use App\News\News;
use App\Modules\Module;
use App\Lang\TranslationService;
use App\User\User;
use App\Services\App;

$checkTable = new App();
$tableName = [
    'news' => "news",
    'users' => "users"
];
$columNews = [
    'id int(10) NOT NULL AUTO_INCREMENT',
    'author varchar(255) NOT NULL',
    'date datetime DEFAULT CURRENT_TIMESTAMP',
    'title_ru varchar(255) NOT NULL',
    'news_ru varchar(500) NOT NULL',
    'title_uk varchar(255) NOT NULL',
    'news_uk varchar(500) NOT NULL',
    'title_en varchar(255) NOT NULL',
    'news_en varchar(500) NOT NULL',
    'news_img varchar(255) NOT NULL',
];

$checkTable->createTableIfNotExists($tableName['news'],$columNews);

$getLang = new User();
$translationService = new TranslationService();
$statistic = new Module();
$NewsHelper = new News();

$LangUrl = $translationService->sessionLang();
$getLangName = $LangUrl ? $LangUrl : $getLang->getUserLanguages();

$translationService->setLocale($getLangName);

Page::part('head');
Page::part('header');

$myNews = $NewsHelper->getNews();

?>

    <main class="main">


        <div class="articles">
            <div class="content-area flex-ss">

                <?php foreach ($myNews as $news): ?>
                    <article class="articles__item">
                        <img src="<?php echo HOSTNAME ?>/news-images/<?php echo $news->news_img ?>" alt="">
                        <div class="articles__item-content flex-ss">
                            <div class="articles__item-date dates"><?php echo $news->date ?></div>
                            <div class="articles__item-title">
                                <a href="/full/<?php echo $news->id ?>"><?php echo $news->{"title_$getLangName"} ?></a>

                            </div>

                            <div class="articles__item-text">
                                <p>Автор: <?php echo $news->author ?></p>
                            </div>
                            <div class="articles__item-text">
                                <p><?php echo $news->{"news_$getLangName"} ?></p>
                            </div>
                            <a href="/full/<?php echo $news->id ?>" class="articles__item-button flex-cc"><span>Читать
									дальше </span><i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
        </div>


        <div class="information">
            <div class="content-area flex-ss">

                <div class="information__box">
                    <div class="information__box-title flex-sc">
                        <div class="information__box-icon castle-icon"><img
                                src="<?php echo ASSETSDIR ?>images/icon/castle_icon.png" alt=""></div>
                        <span class="information__box-name"><?php echo $translationService->trans('castleRatting'); ?></span>

                    </div>
                    <div class="information__box-content">
                        <div class="top-castle">
                            <div class="top-castle__title flex-sbc">
                                <div class="top-castle__title-col"><?php echo $translationService->trans('castleName'); ?></div>
                                <div class="top-castle__title-col"><?php echo $translationService->trans('castleOwner'); ?></div>
                            </div>
                            <?php foreach ($statistic->getСastleEndOwner() as $castle): ?>
                            <div class="top-castle__line flex-sbc">
                                <div class="top-castle__line-icon"><img
                                        src="template/panel/assets/media/castle/1.jpg" alt=""></div>
                                <div class="top-castle__line-name"><span data-desc="<?php echo $castle['name']?> Castle"
                                                                         data-desc-size="1600"><?php echo $castle['name']?> Castle</span>
                                </div>
                                <div class="top-castle__line-clan"><span data-desc="<?php echo $castle['char_name']?>"
                                                                         data-desc-size="1600"><?php echo $castle['char_name']?></span></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="information__box">
                    <div class="information__box-title flex-sc">
                        <div class="information__box-icon"><img src="<?php echo ASSETSDIR ?>images/icon/swords_icon.png"
                                                                alt=""></div>
                        <span class="information__box-name"><?php echo $translationService->trans('rattingCharacters'); ?></span>
                    </div>
                    <div class="information__box-content">

                        <div class="top-players">
                            <div class="top-players__title flex-sbc">
                                <div class="top-players__title-icon">№</div>
                                <div class="top-players__title-name"><?php echo $translationService->trans('character'); ?> </div>
                                <div class="top-players__title-pvp">PvP</div>
                                <div class="top-players__title-pk">PK</div>
                            </div>

                            <?php foreach ($statistic->getUsersPvp($pvpStatCount) as $i => $char): ?>
                                <div class="top-players__line flex-sbc">
                                    <div class="top-players__line-icon flex-cc"><?php echo $i + 1 ?></div>
                                    <div class="top-players__line-name"><span
                                            data-desc="<?php echo $char['char_name'] ?>"
                                            data-desc-size="1300"><?php echo $char['char_name'] ?></span></div>
                                    <div class="top-players__line-pvp"><span><?php echo $char['pvpkills'] ?></span>
                                    </div>
                                    <div class="top-players__line-pk"><span><?php echo $char['pkkills'] ?></span></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="information__box">
                    <div class="information__box-title flex-sc">
                        <div class="information__box-icon"><img src="<?php echo ASSETSDIR ?>images/icon/forum_icon.png"
                                                                alt=""></div>
                        <span class="information__box-name"><?php echo $translationService->trans('themeWithForum'); ?></span>
                    </div>
                    <div class="information__box-content">
                        <div class="posts">
                            <?php foreach ($statistic->getForumTopic($forumTopicCount) as $topic):
                                $author = $statistic->getTopicAuthor($topic['starter_id']);
                                ?>
                                <div class="posts__item flex-sbc">
                                    <div class="posts__item-icon"><img
                                            src="<?php echo $forumLink ?>/uploads/<?php echo $author[0]['pp_thumb_photo'] ? $author[0]['pp_thumb_photo'] : 'default.png' ?>"
                                            alt=""></div>
                                    <div class="posts__item-info">
                                        <div class="posts__item-title">
                                            <a href="<?php echo $forumLink ?>/index.php?showtopic=<?php echo $topic['tid'] ?>"
                                               target="_blank"><?php echo $topic['title'] ?></a>
                                        </div>
                                        <div class="posts__item-sub flex-ss">
                                            <div class="posts__item-author">Автор:
                                                <?php
                                                if (!empty($author)) {
                                                    echo '<a href="'.$forumLink.'/index.php?showuser=' . $topic['starter_id'] . '" target="_blank">' . $author[0]['name'] . '</a>';
                                                }
                                                ?>
                                            </div>
                                            <div class="posts__item-date"><?php echo date('d.m.Y H:i', $topic['start_date']) ?></div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


<?php Page::part('footer'); ?>