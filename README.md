# psicol
Ticket office project

## Api Configuration

To configure the project for the first time

Once you have the database created and configured in the .env file
```
cd api
composer install
php artisan key:generate
php artisan migrate:refresh --seed
php artisan serve
php artisan passport:install
php artisan serve
```
The following field must be added to the .env file: KEY_TOKEN=PSICOL_TOKEN


## Client Configuration

To configure the project for the first time

Once you have the database created and configured in the .env file
```
cd client
composer install
php artisan key:generate
php artisan migrate:refresh --seed
php artisan serve
php artisan passport:install
```
