
# Git конфиг

### Ошибка связанная с памятью при создании репозитория:

~~~bash 
git config --global pack.windowMemory "100m"
git config --global pack.packSizeLimit "100m"
~~~

### Ограничить потоки (поможет при ошибке когда разворачиваешь git):

~~~bash	
git config --global pack.threads "1"
~~~

### Ошибка на windows ( filename too long ) — git config --system core.longpaths true