# psicol
Ticket office project

## Configuration

To configure the project for the first time

Once you have the database created and configured in the .env file
```
composer install
php artisan key:generate
php artisan migrate:refresh --seed
php artisan serve
php artisan passport:install
```
