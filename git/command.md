# Git команды
### Обновить локальную ветку с удаленной
~~~bash 
git checkout <branch_name>
git pull -s recursive -X theirs
git reset --hard origin/<branch_name>
git fetch
~~~

### Перестать отслеживать локальный файл:
Если файл есть в удаленном репозитории:

~~~bash 
Выполнить — git update-index --assume-unchanged youfilename
Отмена — git update-index --no-assume-unchanged youfilename
~~~

Если файла в удаленном репозитории нет, нужно прописать путь к нему в файле .git/info/exclude 


## Создать ветку

~~~bash 
git checkout -b <branchName>
~~~

### Стянуть коммит из ветки А в ветку Б

~~~bash 
git cherry-pick <commit>
~~~

### Подтянуть удаленную ветку

~~~bash 
git fetch origin
~~~

### Удалить удаленную ветку

~~~bash 
git push origin --delete <branchName>
~~~

### Удалить локальную ветку

~~~bash 
git branch -d <branchName>
~~~

### Дополнить локальный коммит

Если забыл что-то добавить в локальный коммит можно его дополнить

~~~bash 
git commit --amend
~~~

### Удалить последний коммит

~~~bash 
git reset --hard HEAD~1
git push -f
~~~
### Восстановить ещё не закоммиченный файл

~~~bash 
git checkout <filename>
~~~

### Удалить untracked файлы:

~~~bash
git clean -n (покажет файлы подлежащие удалению)
git clean -f (удалит файлы)
git clean -fd -f (удалит файлы, директории)
~~~

### Если нужно перенести незакоммиченные изменения из одной ветки в другую (например забыл переключить ветку):

~~~bash 
git stash
git checkout <ветка>
git stash pop
~~~