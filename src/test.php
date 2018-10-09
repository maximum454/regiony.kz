<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? IncludeTemplateLangFile(__FILE__); ?>
<?
CModule::IncludeModule("iblock");
$db_props = CIBlockElement::GetProperty(35, 106, "sort", "asc", array());
$PROPS = array();
while ($ar_props = $db_props->Fetch()) {
    $PROPS[$ar_props['CODE']] = $ar_props['VALUE'];
}
//print_r($PROPS);
?>
<!doctype html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>" class="<? $APPLICATION->ShowProperty('HtmlClass'); ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <? $APPLICATION->SetAdditionalCSS("/bitrix/templates/" . SITE_TEMPLATE_ID . "/css/regiony.css"); ?>
    <? $APPLICATION->ShowHead() ?>
</head>
<body class="<? $APPLICATION->ShowProperty('BodyClass'); ?>" <? $APPLICATION->ShowProperty('BodyTag'); ?>>
<? $APPLICATION->ShowPanel(); ?>
<div class="wrp">
    <header class="header">
        <div class="container">
            <div class="row">
                <a href="#" class="header__a1 col-12">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/bannerА1.png" alt="Баннер А1 ">
                </a>
            </div>
            <div class="row d-flex justify-content-between align-items-center">
                <a href="/" class="header__logo col-lg-3">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg" alt="">
                </a>
                <div class="col-5">
                    <?$APPLICATION->IncludeComponent("bitrix:search.form", "form-search", Array(
                        "COMPONENT_TEMPLATE" => "flat",
                        "PAGE" => "#SITE_DIR#ru/search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                        "USE_SUGGEST" => "N",	// Показывать подсказку с поисковыми фразами
                    ),
                        false
                    );?>
                </div>
                <div class="col-1">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            RU
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/ru/">RU</a>
                            <a class="dropdown-item" href="/en/">EN</a>
                            <a class="dropdown-item" href="/kz/">KZ</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <form action="">
                        <?
                        if (!empty($_REQUEST['show']) && in_array($_REQUEST['show'], array('list', 'full')) === true) {
                            $_SESSION['someentity_show'] = $_REQUEST['show'];
                        } elseif (empty($_SESSION['someentity_show'])) {
                            $_SESSION['someentity_show'] = 'list';
                        }
                        $_SESSION['AREA'] = '';


                        $arFilter = array(
                            'IBLOCK_ID' => 3, // выборка элементов из инфоблока с ИД равным «3»
                            'ACTIVE' => 'Y',  // выборка только активных элементов
                        );

                        $res = CIBlockElement::GetList(array(), $arFilter, false, false, array('ID','NAME','ACTIVE'));
                        ?>
                        <select onchange="this.form.submit()" class="custom-select d-block w-100 js-select-area" id="select-area" name="select-area">
                            <? while ($element = $res->GetNext()) { ?>
                                <option value="<?= $element['ID'] ?>"><?= $element['NAME'] ?></option>
                            <? } ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <? $APPLICATION->IncludeComponent("bitrix:menu", "menu", Array(
        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
        "DELAY" => "N",    // Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "1",    // Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
            0 => "",
        ),
        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
        "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
    ),
        false
    ); ?>
    <main>
        <?// внутрениие страницы?>
        <? if ($APPLICATION->GetCurPage(false) !== '/ru/'): ?>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "breadcrumb",
                        array(
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0",
                            "COMPONENT_TEMPLATE" => "breadcrumb"
                        ),
                        false
                    ); ?>
                    <h1 class="h1"><? $APPLICATION->ShowTitle(); ?></h1>
        <? endif; ?>

                    #WORK_AREA#
        <? if ($APPLICATION->GetCurPage(false) !== '/ru/'): ?>
                    <br>
                    <br>
                </div>
                <div class="col-4">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_RECURSIVE" => "Y",
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "aside-right",
                            "EDIT_TEMPLATE" => ""
                        )
                    );?>
                </div>

                <div class="col-12">

                </div>
            </div>
        </div>
        <? endif; ?>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy;&nbsp;2018 Regiony.kz. Все права защищены</p>
                    <p>Любое использование материалов допускается только при наличии гиперссылки на&nbsp;regiony.kz</p>
                    <p><img src="<?= SITE_TEMPLATE_PATH ?>/img/count.png" alt=""></p>
                </div>
                <div class="col-lg-6">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "menu-footer",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "bottom",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "menu-footer"
                        ),
                        false
                    ); ?>
                    <div class="social">
                        <div class="social__title mb-3">Мы в социальных сетях:</div>
                        <a href="#"><img src="<?= SITE_TEMPLATE_PATH ?>/img/fb.svg" alt=""></a>
                        <a href="#"><img src="<?= SITE_TEMPLATE_PATH ?>/img/vk.svg" alt=""></a>
                        <a href="#"><img src="<?= SITE_TEMPLATE_PATH ?>/img/inst.svg" alt=""></a>
                        <a href="#"><img src="<?= SITE_TEMPLATE_PATH ?>/img/tube.svg" alt=""></a>
                        <a href="#"><img src="<?= SITE_TEMPLATE_PATH ?>/img/telegram.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<? $APPLICATION->AddHeadScript("/bitrix/templates/" . SITE_TEMPLATE_ID . "/js/regiony.js"); ?>
</body>
</html>