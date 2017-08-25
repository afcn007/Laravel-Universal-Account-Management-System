## About Laravel-Universal-Account-Management-System

LUAMS = Laravel 5.4 + Passport 3.0 + AdminLTE 2.4.0 + VUE
<br>
LUAMS is a web account system that support OAuth2 authorization.

## Install
composer install
<br>
copy .env.example .env
<br>
"change .env CACHE_DRIVER to redis"
<br>
php artisan key:generate
<br>
php artisan passport:install
<br>
php artisan migrate --seed
<br>
chmod -R 777 bootstrap/cache
<br>
chmod -R 777 storage
<br>
chmod -R 777 public/upload/
<br>
## Requires
php > 7.0
<br>
redis or memcache for cache



## License

The LUAMS is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
