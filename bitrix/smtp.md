# 1C-Bitrix smtp

<b>Порядок установки:</b>
1. Настроить cron
2. Настроить аккаунт ( в примере используется Yandex )
3. Настроить конфиг для bitrixVM <b>или</b> установить модуль и настроить его для сайта на хостинге.
4. Изменить почту в настройках главного модуля, для каждого сайта и в настройках модуля интернет магазин при необходимости.

### Настройка аккаунта Yandex:
1. Перейти на почту, далее `#setup/client`
2. Включить доступ "С сервера imap.yandex.ru по протоколу IMAP" (Пароли приложений и OAuth-токены) 
3. Также можно установить пароль отдельно для smtp перейдя на [страницу](https://id.yandex.ru/security), пролистать вниз и зайти в "Пароли приложений", далее сгенерировать пароль и использовать его при настройке smtp.

### Настройка на хостинге
1. Устанавливаем [модуль](https://marketplace.1c-bitrix.ru/solutions/wsrubi.smtp/#tab-about-link)<br>
2. Настраиваем модуль
3. Тестируем ( У модуля есть встроенный функционал для теста )

### Настройка на bitrixVM и выделенном сервере

При установке на bitrixVM нужно:
1. Подключится по ssh и зайти в меню управления машиной.
2. Перейти в пункт `6. Configure pool sites`
3. Перейти в пункт `4. Change e-mail settings on site`
4. Ввести данные.

BitrixVM сама создаст конфиг. Пример конфига: 

~~~bash
# smtp account configuration for <Профиль сайта>
account <Логин аккаунта>
logfile /home/bitrix/msmtp_<Название log файла>.log
host <host, для яндекса smtp.yandex.ru>
port <Порт>
from <Почта>
aliases /etc/aliases
keepbcc off
auth on
user <Логин от почты>
password <Пароль от почты>

tls on
tls_certcheck off
tls_starttls on
~~~

### Источники:
1. [Инструкции по настройке почты на Yandex](https://www.dextra.ru/about/forclients/mail_configuration/)
2. [Документация 1C-Bitrix](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=37&CHAPTER_ID=08853)
3. [Инструкция по установки smtp от timeweb](https://timeweb.com/ru/docs/virtualnyj-hosting/cms/otpravka-pochty-s-sajta-cherez-smtp/)