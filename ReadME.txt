 
Начальные условия(ubuntu)
На компьютере должен быть установлен docker (желательно, но не обязательно Docker Desktop) https://docs.docker.com/get-docker/ и docker compose https://docs.docker.com/compose/install/

После чего запускаем проект

docker compose up -d
запуститься три контейнера - php, nginx,postgres

Начинаем проект Symfony skeleton
заходим в контейнер
docker exec -it php-skeleton  /bin/bash
устанавливаем симфу

composer install

Добавляем
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
composer require symfony/security-bundle
symfony composer req api

Добавляем в .env файл

DATABASE_URL="postgresql://paybis:paybis@postgres:5432/postgres_pb"

 Использование приложения
При наличии локально установленного PHP необходимо клонировать репозитарий, установить пакеты, создать БД, выполнить миграции и обновить курсы валют

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console currency:update
