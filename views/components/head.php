<?php
use App\User\User;
use App\Lang\TranslationService;

$userHelper = new User();
$translationService = new TranslationService();

$LangUrl = $translationService->sessionLang();
$getLangName = $LangUrl ? $LangUrl : $userHelper->getUserLanguages();
$translationService->setLocale($getLangName);

?>
<!DOCTYPE html>
<html lang="<?php echo $getLangName ?>">

<!-- Mirrored from worldofaden.ru/ru by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 22 Mar 2022 23:41:28 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->

<head>
    <title><?php echo $_SERVER['HTTP_HOST'] ?> Сайт сервера Seaborgium.</title>
    <meta property="og:title" content="<?php echo $_SERVER['HTTP_HOST'] ?> Сайт сервера Lineage2.">
    <meta property="og:site_name" content="<?php echo $_SERVER['HTTP_HOST'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="index.html">
    <meta name="description" content="<?php echo $_SERVER['HTTP_HOST'] ?> Сайт сервера Lineage2!">
    <meta property="og:description" content="<?php echo $_SERVER['HTTP_HOST'] ?> Сайт сервера Lineage2!">
    <meta property="twitter:description" content="<?php echo $_SERVER['HTTP_HOST'] ?> Сайт сервера Lineage2!">
    <meta name="keywords" content="prime-time">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo ASSETSDIR ?>images/favicon.ico">
    <link rel="stylesheet" href="<?php echo ASSETSDIR ?>css/style.css">
    <link href="<?php echo ASSETSDIR ?>libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://www.googletagmanager.com/gtag/js?id=UA-167385217-1" async="true"></script>
    <script>window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-167385217-1', {'anonymize_ip': true});</script>
    <script>   (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "../mc.yandex.ru/metrika/tag.js", "ym");
        ym(63491560, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });</script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/63491560" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
</head>

<body>
<!-- wrapper -->
<div class="wrapper">


