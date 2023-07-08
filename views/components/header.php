
<?php
use App\User\User;
use App\Lang\TranslationService;
use App\Modules\Module;

$getOnline = new Module();
$online = $getOnline->getOnlineGame()['total_online'];

$userHelper = new User();
$translationService = new TranslationService();

$LangUrl = $translationService->sessionLang();
$getLangName = $LangUrl ? $LangUrl : $userHelper->getUserLanguages();
$translationService->setLocale($getLangName);

?>




<header class="header">
    <nav class="nav">
        <div class="content-area flex-sbc">

            <div class="open-main-menu">
                <div class="open-main-menu__item"></div>
            </div>


            <div class="nav__links flex-sc">

                <div class="nav__link" style="order: 6;">
                    <a href="<?php echo $translationService->trans('forumLink'); ?>"
                       target="_blank"><?php echo $translationService->trans('forum'); ?></a>
                </div>
                <div class="nav__link" style="order: 5;">
                    <a href="<?php echo $translationService->trans('donateLink'); ?>"><?php echo $translationService->trans('donate'); ?></a>
                </div>
                <div class="nav__link" style="order: 4;">
                    <a href="<?php echo $translationService->trans('statisticLink'); ?>"><?php echo $translationService->trans('statistic'); ?></a>
                </div>
                <div class="nav__link" style="order: 3;">
                    <a href="<?php echo $translationService->trans('filesLink'); ?>"><?php echo $translationService->trans('files'); ?></a>
                </div>
                <div class="nav__link" style="order: 2;">
                    <a href="<?php echo $translationService->trans('aboutLink'); ?>" target="_blank"><?php echo $translationService->trans('about'); ?></a>
                </div>
                <div class="nav__link" style="order: 1;">
                    <a href="<?php echo $translationService->trans('homeLink'); ?>"><?php echo $translationService->trans('home'); ?></a>
                </div>

            </div>


            <div class="nav__langs">


                <div class="nav__langs-items flex-ss">
                    <div class="nav__langs-arrow"></div>

                    <a href="/ru" class="nav__langs-item flex-sc <?php
                    if ($_SESSION['lang'] == 'ru') {
                        echo 'active';
                    }
                    ?>">
                        <div class="nav__langs-item-icon">
                            <img src="<?php echo ASSETSDIR ?>images/icon/ru_icon.png" alt="ru">
                        </div>
                        <div class="nav__langs-item-name">ru</div>
                    </a>
                    <a href="/en" class="nav__langs-item flex-sc <?php
                    if ($_SESSION['lang'] == 'en') {
                        echo 'active';
                    }
                    ?>">
                        <div class="nav__langs-item-icon">
                            <img src="<?php echo ASSETSDIR ?>images/icon/en_icon.png" alt="en">
                        </div>
                        <div class="nav__langs-item-name">en</div>
                    </a>
                    <a href="/uk" class="nav__langs-item flex-sc <?php
                    if ($_SESSION['lang'] == 'uk') {
                        echo 'active';
                    }
                    ?>">
                        <div class="nav__langs-item-icon">
                            <img src="<?php echo ASSETSDIR ?>images/icon/uk_icon.png" alt="uk">
                        </div>
                        <div class="nav__langs-item-name">UA</div>
                    </a>
                </div>

            </div>

            <a href="<?php echo $translationService->trans('cabinetLink'); ?>" class="button small"><span
                    class="text"><?php echo $translationService->trans('cabinet'); ?></span><span
                    class="icon"><i class="fas fa-user"></i></span></a>
        </div>
    </nav>
    <div class="header__content">
        <div class="content-area">

            <a href="index.html" class="header__logo"><img src="<?php echo ASSETSDIR ?>images/logos/logo.png"
                                                           alt=""></a>
            <div class="header__info">
                <div class="header__info-title"><?php echo $translationService->trans('headerTitle'); ?></div>
                <div class="header__info-text"><?php echo $translationService->trans('headerText'); ?>
                </div>
            </div>

            <a href="<?php echo $translationService->trans('startGameLink'); ?>"
               class="button big header__button"><span><?php echo $translationService->trans('startGame'); ?></span></a>

            <div class="header__status">

                <div class="header__status-online"><?php echo $translationService->trans('online'); ?> :
                    <span><?php echo $online * $translationService->trans('onlineMultiply'); ?></span>
                </div>


                <div class="header__status-sub"><?php echo $translationService->trans('serverStartWith'); ?>

                </div>

                <div class="header__status-sub2"><?php echo $translationService->trans('serverStatus'); ?></div>


                <div class="header__status-link"><a
                        href="<?php echo $translationService->trans('showMoreStatisticLink'); ?>"><?php echo $translationService->trans('showMoreStatistic'); ?></a>
                </div>
            </div>

        </div>
    </div>
</header>