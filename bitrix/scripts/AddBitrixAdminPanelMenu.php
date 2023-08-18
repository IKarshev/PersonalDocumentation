<?
// инициализируем пункт меню
// /local/php_interface/init.php
AddEventHandler('main', 'OnBuildGlobalMenu', 'addMenuItem');
function addMenuItem(&$aGlobalMenu, &$aModuleMenu)
{
    global $USER;

    if ($USER->IsAdmin()) {

        $aGlobalMenu['global_menu_custom'] = [
            'menu_id' => 'kontur',
            'text' => 'kontur',
            'title' => 'kontur',
            'url' => 'settingss.php?lang=ru',
            'sort' => 1000,
            'items_id' => 'global_menu_custom',
            'help_section' => 'custom',
            'items' => [
                [
                    'parent_menu' => 'global_menu_custom',
                    'sort'        => 10,
                    'url'         => '/bitrix/admin/excel_parse.php',
                    'text'        => "Excel парсер реестров",
                    'title'       => "Excel парсер реестров",
                    'icon'        => 'fav_menu_icon',
                    'page_icon'   => 'fav_menu_icon',
                    'items_id'    => 'menu_custom',
                ],
            ],
        ];

    }
}
?>