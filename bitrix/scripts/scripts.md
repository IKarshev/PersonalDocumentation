# Скрипты

- `copy_infoblock.php` - Копирование свойств инфоблока
- `resave_infoblocks.php` - Пересохраняет инфоблоки, полезно когда нужно заново массово инициализировать события типа onIblockElementUpdate
- `add_bitrix_admin_panel_menu.php` - Добавляем элемент меню в админку битрикс
- `additional_fields_in_mail_event.php` - доп поля в почтовом событие при заказе.php
- `BD bitrix.php` - Класс для работы с бд в 1C-bitrix
- `watermark.php` - Добавление водяного знака api-bitrix

### Получить id инфоблока по коду aspro:
~~~bash
CCache::$arIBlocks[SITE_ID]['<Код типа инфоблока>']['код инфоблока'][0]
~~~