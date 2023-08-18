# PersonalDocumentation
Скрипты, заметки, шаблоны, заготовки и т.д. для личного использования

## Git

- [Команды](https://github.com/IKarshev/PersonalDocumentation/blob/main/git/command.md)
- [Настройка конфигурации](https://github.com/IKarshev/PersonalDocumentation/blob/main/git/config.md)
- [Установка ssh ключа](https://github.com/IKarshev/PersonalDocumentation/blob/main/git/ssh_key.md)

## Linux

- [Команды](https://github.com/IKarshev/PersonalDocumentation/blob/main/linux/command.md)
- [Поиск потенциально завирусованных файлов](https://github.com/IKarshev/PersonalDocumentation/blob/main/linux/ai-bolit.md)

## 1C-Bitrix
- [Баги, ошибки](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/Bags.md)
- [Скрипты](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/scripts/scripts.md)
- [Всё про 1с](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/1с/1с.md)
- [Вирусы](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/virus/virus.md)
- [smtp](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/smtp.md)
- [Сброс истекшей демо версии](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/RefreshDemo.md)

---

- [bitrix кастомная сортировка](https://dev.1c-bitrix.ru/community/forums/forum6/topic141192/)
- [bitrix очистка upload от уже удаленный файлов](https://github.com/Mediahero/bitrix-clear-upload)
## Php

## Js

### Полезные ссылки
- [Большой справочник по htaccess](http://htaccess.net.ru/)
- [Сервис для проверки почты](https://www.mail-tester.com/)
- [Сервис-генератор rewriterule](https://donatstudios.com/RewriteRule_Generator)
- [проверка на last-modified](https://last-modified.com/)
- [bitrix24 api](https://dev.1c-bitrix.ru/rest_help/?_gl=1*1camlpk*_ga*ODIyNzQzMzgyLjE2ODQ3Mzc1Mjk.*_ga_0X7ZLV9Y7K*MTY5MjE3MDc2Ny4xMC4xLjE2OTIxNzExMTguNjAuMC4w)


# Часто используемые команды
### Команды для поиска строки внутри файлов:
~~~bash
find public_html -type f -name "*.php" -exec grep -i -H 'Искомое_значение'  {} \; | tee -a poisk.log
~~~
Можно исключить папку:
~~~bash
-not -path "*/bitrix/chache/*"
~~~
Поиск файлов по названиям:
~~~bash
find public_html/ -name "название файла"
~~~
