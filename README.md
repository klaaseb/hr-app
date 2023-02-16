# Hr App

## prereqs

- php > 8.0
- composer
- symfony cli with dev server or docker container with php8 and composer

## install steps

These steps will create a new sqlite db and populate it with the start data.

1. composer i
2. php bin/console doctrine:database:create
3. php bin/console doctrine:migrations:migrate
4. php bin/console doctrine:fixtures:load
