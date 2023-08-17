
# Git генерация ssh-ключа

[Документация git](https://docs.github.com/ru/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)

## 1. Сгенерировать ключ 

Будет генерироваться пара ключей.

~~~bash 
ssh-keygen -t ed25519 -C "<e-mail>"
~~~

## 2. Сохранить ключ в настройки Git
github->профиль->settings->ssh and GPG keys->add new->вставить публичный ключ

## 3. Добавить ключ

### На linux
~~~bash 
eval `ssh-agent -s`
ssh-add ~/.ssh/<YOUR_GENERATED_RSA_FILE>
~~~

### На windows

~~~bash 
start-ssh-agent.cmd
ssh-add ~/.ssh/<YOUR_GENERATED_RSA_FILE>
~~~


### 4. После создания и добавления ключа на git:

Если до добавления ssh использовался к примеру токен, нужно выполнить команды:
	
~~~bash 
git remote remove origin
git remote add origin <ссылка "github->code->ssh">
~~~