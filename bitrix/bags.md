# 1C-Bitrix Баги, ошибки

### Ошибка с сессией при установке битрикс на timeweb:
1. Создал директорию
`/home/c/cp52296/cp52296.tmweb.ru/public_html/tmp/session`<br>
2. добавил в файл .htaccess параметр
~~~bash
php_value session.save_path /home/c/cp52296/cp52296.tmweb.ru/public_html/tmp/session
~~~

### Проблема со входом в админку битрикс из-за проектной защиты:
В файле `bitrix/modules/main/include.php` закомментить строки:
~~~bash
foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
ExecuteModuleEventEx($arEvent);
~~~


### Не дает зайти в админку из-за доступа по IP


Если в битриксе стоит доступ по ip, можно временно отключить с помощью скрипта и добавить свой ip в список.<br>
Нужно открыть страницу со скриптом. На страницу выведется имя файла который надо создать пустым, что отменит блокировку.

~~~bash
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
echo COption::GetOptionString("security", "ipcheck_disable_file");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
~~~

<b>После операции файл нужно удалить</b><br>
Тоже самое запросом:

~~~bash
select * from b_option where MODULE_ID = 'security' and NAME = 'ipcheck_disable_file';
~~~