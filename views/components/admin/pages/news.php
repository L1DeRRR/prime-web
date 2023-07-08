<?php

use App\Services\Page;
use App\News\News;
use App\User\User;


if ($_SESSION['user_level'] === '100') :
$userHelper = new User();
$newsHelper = new News();
$myNews = $newsHelper->getNews();

Page::part('head', 'admin');
Page::part('sidebar', 'admin');

if (!empty($_POST['news_title_ru']) && !empty($_POST['news_text_ru'])) {
    $title_ru = $_POST['news_title_ru'];
    $news_ru = $_POST['news_text_ru'];
    $title_uk = $_POST['news_title_uk'];
    $news_uk = $_POST['news_text_uk'];
    $title_en = $_POST['news_title_en'];
    $news_en = $_POST['news_text_en'];


    $news_img = $_FILES['news_img'];

    $fileName = time() . '-' . $news_img['name'];
    $destination = 'news-images/' . $fileName;
    $user = $userHelper->getUserById();
    if (move_uploaded_file($news_img['tmp_name'], $destination)) {
        $myNews = R::dispense('news');

        $myNews->title_ru = $title_ru;
        $myNews->news_ru = $news_ru;
        $myNews->title_uk = $title_uk;
        $myNews->news_uk = $news_uk;
        $myNews->title_en = $title_en;
        $myNews->news_en = $news_en;

        $myNews->news_img = $fileName;
        $myNews->author = $user->name;

        R::store($myNews);
        $uploadedImages[] = $fileName;

        $sql = "INSERT INTO `news` (`title`, `news`, `news_img`) VALUES (:title_ru, :news_ru,:title_uk, :news_uk,:title_en, :news_en, :news_img)";
        $options = [
            ':title_ru' => $title_ru,
            ':news_ru' => $news_ru,
            ':title_uk' => $title_uk,
            ':news_uk' => $news_uk,
            ':title_en' => $title_en,
            ':news_en' => $news_en,
            ':news_img' => $fileName
        ];
    }
}
?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">
            <?php Page::part('navbar', 'admin'); ?>
            <div class="p-3 text-white">
                <form id="add_news" method="post" class="w-50 m-auto bg-secondary p-5 rounded-1" action=""
                      enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Фон</label>
                        <input type="file" class="form-control" name="news_img">
                    </div>
                    <div>
                        <h5>Новость: Ru</h5>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                            <input type="text" name="news_title_ru" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Новость</label>
                            <textarea class="form-control" name="news_text_ru" rows="3"></textarea>
                        </div>
                    </div>
                    <div>
                        <h5>Новость: Uk</h5>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                            <input type="text" name="news_title_uk" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Новость</label>
                            <textarea class="form-control" name="news_text_uk" rows="3"></textarea>
                        </div>
                    </div>
                    <div>
                        <h5>Новость: En</h5>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Заголовок</label>
                            <input type="text" name="news_title_en" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Новость</label>
                            <textarea class="form-control" name="news_text_en" rows="3"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-success w-100">Добавить</button>
                </form>
            </div>

            <div class="bg-secondary m-2">
                <div class="articles">
                    <div class="content-area flex-ss d-flex p-4 gap-2 flex-wrap justify-content-center">
                        <?php
                        if ($newsHelper->checkTableData('news')) { ?>
                            <?php
                            $myNews = $newsHelper->showNews();
                            foreach ($myNews as $news) {
                                ?>
                                <article style="width: 30%" class="articles__item bg-light p-2 rounded-1">
                                    <div class="d-flex justify-content-between position-relative">
                                        <img width="100%" height="auto"
                                             src="<?php echo HOSTNAME ?>/news-images/<?php echo $news['news_img'] ?>"
                                             alt="">
                                        <button data-id="<?php echo $news['id'] ?>"
                                                class="remove_news btn btn-close bg-danger position-absolute end-0"></button>
                                    </div>
                                    <div class="articles__item-content flex-ss">
                                        <div
                                            class="articles__item-date dates bg-danger w-50 m-auto p-2 rounded-1 text-white fw-bold text-center mt-2"><?php echo $news['date'] ?></div>
                                        <div class="articles__item-title">
                                            <p class="bg-secondary p-2 mt-2 text-center text-white fw-bold rounded-2"><?php echo $news['title_ru'] ?></p>
                                        </div>

                                        <div class="articles__item-text">
                                            <p>Автор: <?php echo $news['author'] ?></p>
                                        </div>
                                        <div class="articles__item-text">
                                            <p class="bg-dark p-2 mt-2 text-white w-100 h-auto rounded-1"><?php echo $news['news_ru'] ?></p>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            }
                            ?>
                        <?php } else { ?>
                            <h4>Новостей нету</h4>
                        <?php }
                        ?>
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
    <!-- End of Content Wrapper -->

<?php Page::part('footer', 'admin'); ?>
<?php else: ?>
    <?php exit(); ?>
<?php endif; ?>
