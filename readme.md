## About Laravel-Universal-Account-Management-System

LUAMS = Laravel 5.4 + Passport 3.0 + AdminLTE 2.4.0 + VUE
LUAMS is a web account system that support OAuth2 authorization.

## Install
composer install
copy .env.example .env
"change .env CACHE_DRIVER to redis"
php artisan key:generate
php artisan migrate --seed

chmod -R 777 bootstrap/cache
chmod -R 777 storage

## Requires
php > 7.0
redis or memcache for cache



## License

The LUAMS is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
