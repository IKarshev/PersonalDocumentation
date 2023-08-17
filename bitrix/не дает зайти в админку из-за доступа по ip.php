<?
/*
* Если в битриксе стоит доступ по ip, можно временно отключить с помощью скрипта и добавить свой ip в список
* Нужно открыть страницу со скриптом, выведет имя файла который надо создать пустым, что отменит блокировку
* После операции файл нужно удалить
*/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
echo COption::GetOptionString("security", "ipcheck_disable_file");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

/*
* Тоже самое запросом: select * from b_option where MODULE_ID = 'security' and NAME = 'ipcheck_disable_file';
*/