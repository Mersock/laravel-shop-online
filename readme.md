## Shop Online with Laravel

This is simple project with laravel with Docker 

`Install`

1. git clone https://github.com/Mersock/shop-online-laravel.git

2. Change file name .env.example to .env

3. Run  `docker-compose up -d`

4. Run  `docker exec laravel-shop-online composer install` or `docker exec laravel-shop-online composer update` 

5. Run  `docker exec laravel-shop-online php artisan key:generate`

6. Run  `docker exec laravel-shop-online php artisan migrate`

7. Run application http://localhost:8000/
