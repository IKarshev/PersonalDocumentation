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
- [Баги, ошибки](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/bags.md)
- [Скрипты](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/scripts/scripts.md)
- [Всё про 1с](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/1с/1с.md)
- [Вирусы](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/virus/virus.md)
- [smtp](https://github.com/IKarshev/PersonalDocumentation/blob/main/bitrix/smtp.md)

## Php

## Js


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
