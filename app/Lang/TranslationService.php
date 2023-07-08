<?php

namespace App\Lang;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;
use App\User\User;

class TranslationService
{
    private $translator;

    public function __construct()
    {
        $this->translator = new Translator('en');
        $this->translator->addLoader('yaml', new YamlFileLoader());

        // Укажите путь к директории с языковыми файлами
        $translationsDir = HOMEDIR . '/lang';

        // Используйте компонент Finder для поиска файлов в директории
        $finder = new Finder();
        $finder->files()->in($translationsDir)->name('*.yaml');

// Загрузите языковые файлы
        foreach ($finder as $file) {
            $locale = $file->getBasename('.yaml');
            $this->translator->addResource('yaml', $file->getPathname(), $locale);
        }

    }

    public function setLocale($locale)
    {
        if ($locale === 'auto') {
            $userHelper = new User();
            $this->translator->setLocale($userHelper->getUserLanguages());
        } else {
            $this->translator->setLocale($locale);
        }
    }

    public function trans($key)
    {
        return $this->translator->trans($key, [], null, $this->translator->getLocale());
    }

    public function sessionLang() {
        if (isset($_GET['q']) && ($_GET['q'] == 'ru' || $_GET['q'] == 'en' || $_GET['q'] == 'uk')) {
            $langValue = $_GET['q'];
            $_SESSION['lang'] = $langValue;
        }

        if (isset($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
        } else {
            // Иначе, используем язык по умолчанию (например, 'ru')
            $getLang = new User();
            $myLang = 'ru';
            $lang = $myLang ? $myLang : $getLang->getUserLanguages();

            // Сохраняем язык в сессии
            $_SESSION['lang'] = $lang;
        }

        return $lang;
    }


}

