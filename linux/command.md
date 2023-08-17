# Linux команды

## Копирование файлов по ssh

флаги:
- r - рекурсивное копирование (для директорий)
- C - использовать сжатие при передачи
- P - порт ssh

### Между серверами
После подключения на сервер <b>откуда нужно скопировать файлы</b>:

~~~bash  
scp <путь до файла(ов)>  username@servername:/directory
~~~

### Локальный файл на сервер

~~~bash  
scp file.gz root@server.my:/home/dir
~~~


### С удаленного сервера на локальную машину

~~~bash  
scp username@example.com:/remote/path/to/file /local/path
~~~



Затем подтвердить подключение к ssh и ввести ssh пароль.

## Сменить владельца/группу

~~~bash  
chown <владелец>:<группа> <путь-до-файла>
~~~

### Проверка процессов на сервере ssh-командами:
~~~bash
ps aux | grep php
~~~
~~~bash
htop
~~~

### Поиск и вывод модифицированный файлов (за последние 30 дней не включая текущего):
~~~bash
find public_html -type f -mtime -30 ! -mtime -1 -printf '%TY-%Tm-%Td %TT %p\n' | sort -r
~~~


### Восстановить файлы из бэкапыа на vds
[Документация](https://www.netangels.ru/support/cloud-vds/disk-mount/)<br>
Кратко:

`fdisk -l` — Посмотреть какие диски доступны внутри вашей ВМ<br>
`mount | grep '/dev'` — Вывод СМОНТИРОВАННЫХ дисков


Выполняем команды:
~~~bash
# mkdir /tmp/backups
# mount /dev/Название диска/tmp/backups
~~~
После исполнения файлы бэкапа хранятся тут — `/tmp/backups/`
