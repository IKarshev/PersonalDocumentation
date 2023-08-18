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


### Ошибка при установке Bitrix на open server
При установки новых версий 1С-Bitrix, работающих на php 8 и выше на Open Server возникают ошибки.

1. Ошибка `Allowed memory size of 1610612736 bytes exhausted (tried to allocate 262144 bytes) in Unknown on line 0 Fatal error ...`:

Необходимо при установке заменить метод в файле `/bitrix/modules/main/lib/security/random.php` на:

~~~bash 
public static function getStringByCharsets($length, $charsetList)
{
       // Временно возвращаем "свою" рандомную строку
       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $randstring = '';
       for ($i = 0; $i < 10; $i++) {
           $randstring = $characters[rand(0, strlen($characters))];
       }
       return $randstring; // Конец

    $charsetVariants = strlen($charsetList);
    $randomSequence = static::getBytes($length);

    $result = '';
    for ($i = 0; $i < $length; $i++)
    {
       $randomNumber = ord($randomSequence[$i]);
       $result .= $charsetList[$randomNumber % $charsetVariants];
    }
    return $result;
}
~~~

После установки нужно вернуть старый метод:
~~~bash
public static function getStringByCharsets($length, $charsetList)
{
    $charsetVariants = strlen($charsetList);
    $randomSequence = static::getBytes($length);

    $result = '';
    for ($i = 0; $i < $length; $i++)
    {
        $randomNumber = ord($randomSequence[$i]);
        $result .= $charsetList[$randomNumber % $charsetVariants];
    }
    return $result;
}
~~~