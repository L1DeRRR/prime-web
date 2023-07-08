<?php
use App\Lang\TranslationService;
use App\User\User;

$userHelper = new User();
$translationService = new TranslationService();

$LangUrl = $translationService->sessionLang();
$getLangName = $LangUrl ? $LangUrl : $userHelper->getUserLanguages();
$translationService->setLocale($getLangName);
?>
<footer class="footer">
    <div class="content-area flex-sbs">
        <div class="footer__cpr">
            <div class="footer__cpr-logo"><img src="<?php echo ASSETSDIR ?>images/logos/f_logo.png" alt=""></div>
            <div class="footer__cpr-text"><?php echo $translationService->trans('copyright'); ?>
            </div>
        </div>
        <div class="footer__nav flex-ss">

            <div class="footer__nav-col flex-ss">

                <div class="footer__nav-item" style="order: 4;">
                    <a href="<?php echo $translationService->trans('aboutLink'); ?>" target="_blank"><?php echo $translationService->trans('about'); ?></a>
                </div>


                <div class="footer__nav-item" style="order: 3;">
                    <a href="<?php echo $translationService->trans('filesLink'); ?>"><?php echo $translationService->trans('files'); ?></a>
                </div>


                <div class="footer__nav-item" style="order: 2;">
                    <a href="<?php echo $translationService->trans('registerLink'); ?>"><?php echo $translationService->trans('register'); ?></a>
                </div>


                <div class="footer__nav-item" style="order: 1;">
                    <a href="<?php echo $translationService->trans('homeLink'); ?>"><?php echo $translationService->trans('home'); ?></a>
                </div>

            </div>
            <div class="footer__nav-col flex-ss">

                <div class="footer__nav-item" style="order: 4;">
                    <a href="<?php echo $translationService->trans('goForumLink'); ?>" target="_blank"><?php echo $translationService->trans('goForum'); ?></a>
                </div>


                <div class="footer__nav-item" style="order: 3;">
                    <a href="<?php echo $translationService->trans('donateLink'); ?>"><?php echo $translationService->trans('donate'); ?></a>
                </div>


                <div class="footer__nav-item" style="order: 2;">
                    <a href="<?php echo $translationService->trans('statisticLink'); ?>"><?php echo $translationService->trans('statistic'); ?></a>
                </div>


                <div class="footer__nav-item" style="order: 1;">
                    <a href="<?php echo $translationService->trans('helperLink'); ?>" target="_blank"><?php echo $translationService->trans('helper'); ?></a>
                </div>

            </div>

        </div>
        <div class="footer__right">
            <div class="footer__social flex-cc">
                <a href="<?php echo $translationService->trans('vkLink'); ?>" target="_blank"><i class="fab fa-vk"></i></a>
                <a href="<?php echo $translationService->trans('fbLink'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo $translationService->trans('youtubeLink'); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <a href="https://freekassa.ru/" title="small-white-2"><img
                    src="<?php echo ASSETSDIR ?>images/logos/small-white-2.png" alt="small-white-2" /></a>
        </div>
    </div>
</footer>
</div>
<!-- end wrapper -->

<script src="<?php echo ASSETSDIR ?>libs/jquery/jquery.js"></script>
<script src="<?php echo ASSETSDIR ?>js/navigation.js"></script>
<script src="<?php echo ASSETSDIR ?>js/scripts.js"></script>
<script src="<?php echo ASSETSDIR ?>js/tablesizer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="../mmo24.ru/webstat/watch.js"></script>
</body>


</html>