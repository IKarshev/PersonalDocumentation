=======================================================================================
windows
На другие ОС - https://docs.github.com/ru/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent
---------------------------------------------------------------------------------------
ssh-keygen -t ed25519 -C "karshev.ivan09.07.38@gmail.com"
start-ssh-agent.cmd
github->профиль->settings->ssh and GPG keys->add new->вставить публичный ключ
=======================================================================================

linux
	включаем ssh — eval `ssh-agent -s`
	Добавляем ключ — ssh-add ~/.ssh/<YOUR_GENERATED_RSA_FILE>

После создания и добавления ключа на git (если до этого не использовался ssh):
	git remote remove origin
	git remote add origin <ссылка "github->code->ssh">
