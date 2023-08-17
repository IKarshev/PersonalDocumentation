Для сброса пробного периодна нужно:
1: Установить новую свежую версию 1с-битрикс например на локалку
2:
Получить значение на свежей версии битрикс (поле VALUE):
SELECT * FROM b_option WHERE `NAME`='admin_passwordh'

Вставить значание в старую версию:
UPDATE b_option
SET `VALUE` = 'скопированное значение'
WHERE `NAME`='admin_passwordh'

3: Скопировать значение "TEMPORARY_CACHE" в свежей версии битрикс (из файла: /bitrix/modules/main/admin/define.php) и вставить это значение в старую разработку.
4: Удалите содержимое (кэш) /bitrix/managed_cache/
5: Чтобы пользоваться маркетплейс: нужно перенести файл со свежей версии: /bitrix/license_key.php

Вечный триал | *Лицензия на маркетплейс КАЖЕТСЯ не обновляется — https://itbuben.ru/2022/09/19/cms/bitrix/vechnyj-trial-bitriks/
1. В файле bitrix\modules\main\admin\define.php заменяем значаение "TEMPORARY_CACHE" на "ARtufgYHb2MMdQgebRtmG24A"
2. В таблице b_option поменять значение ключа admin_passwordh на "FVgQeWYUBgQtCUVcBxcGCgsTAQ=="
3. Очистить папку bitrix/managed cache
4. Для удаления надписи в админке – правим файл \bitrix\modules\main\interface\prolog_main_admin.php 351 строка,

Находим echo BeginNote и делаем display:none как в примере ниже.
//echo BeginNote('style="position: relative; top: -15px;"');
echo BeginNote('style="display:none;"');

