 
Начальные условия
На компьютере должен быть установлен docker (желательно, но не обязательно Docker Desktop) https://docs.docker.com/get-docker/ и docker compose https://docs.docker.com/compose/install/

После чего запускаем проект

docker compose up -d
запуститься три контейнера - php-fpm, nginx, postgresql

Начинаем проект Symfony skeleton
заходим в контейнер
docker exec -it php-skeleton  /bin/bash
устанавливаем симфу

composer install
Добавляем
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
composer require symfony/security-bundle
Добавляем в .env файл

DATABASE_URL="postgresql://usr:97y2amDpm@pg-cmf:5432/usr?serverVersion=15&charset=utf8"
MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0
