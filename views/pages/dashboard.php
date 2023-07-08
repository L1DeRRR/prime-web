<?php
session_start();
use App\Services\Page;

Page::part('head', 'admin');
Page::part('message');
if (isset($_SESSION['user_level'])) {
    if ($_SESSION['user_level'] === '100') {
        Page::part('sidebar', 'admin');
        Page::connect('home');

    }
} else {
    ?>
    <div class="mt-5 w-100">
        <div class="bg-secondary text-center w-100 col-md-6 m-auto p-3">
            <form id="login_form" action="/auth/login">
                <h5 class="text-white font-weight-bold">Панель Администратора</h5>
                <div class="input-group mb-3 mt-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Логин</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" name="login"
                           aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Пароль</span>
                    <input type="password" class="form-control" name="password" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-default">
                </div>
                <button class="btn btn-danger w-100 mt-2" type="submit">Войти</button>
            </form>
        </div>
    </div>
    <?php
}
?>
<?php Page::part('footer', 'admin'); ?>
