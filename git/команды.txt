================================================================
Обновить локальную ветку с удаленной
----------------------------------------------------------------
git checkout <branch_name>
git pull -s recursive -X theirs
git reset --hard origin/<branch_name>
git fetch
================================================================
Перестать отслеживать локальный файл:
Если файл есть в удаленном репозитории:
	Выполнить — git update-index --assume-unchanged youfilename
	Отмена — git update-index --no-assume-unchanged youfilename
Если файла в удаленном репозитории нет, нужно прописать путь к нему в файле .git/info/exclude 
================================================================
Создать ветку: git checkout -b <branchName>
Стянуть коммит из ветки А в ветку Б: git cherry-pick <commit>

Подтянуть удаленную ветку: git fetch origin

Удалить удаленную ветку: git push origin --delete <branchName>
Удалить локальную ветку: git branch -d <branchName>
Если забыл что-то добавить в локальный коммит можно сделать изменения и: git commit --amend

Удалить последний коммит:
	git reset --hard HEAD~1
	git push -f

Восстановить ещё не закоммиченный файл: git checkout HEAD <filename>

Удалить untracked файлы:
	git clean -n (покажет файлы подлежащие удалению)
	git clean -f (удалит файлы)
	git clean -fd -f (удалит файлы, директории)

Если нужно перенести незакоммиченные изменения из одной ветки в другую (например забыл переключить ветку):
	git stash
	git checkout <ветка>
	git stash pop