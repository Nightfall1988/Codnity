<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Setup

1. Open a terminal in <b>Codnity</b> directory

2. Make a <b>composer install</b> command 

3. Make a <b>npm install</b> command 

4. Rename .env.example file to simply <b>.env</b>

5. Create the database named <b>Codnity</b>

5. Make a migration by entering <b>php artisan migrate</b> command

6. Seed the database with test user <b>php artisan db:seed --class=UserSeeder</b> to login into     application, or Register in an application.

7. Run <b>npm run dev</b> command

8. Run <b>php artisan serv</b> to start the server

_______________________
## Scraping and Importing Data

1. To import data from https://news.ycombinator.com/  Run a command: <b>php artisan scraper:hackers-news</b>

2. To update points run: <b>php artisan update:points</b>

3. To test if the scheduler is updating points, run <b>php artisan schedule:work</b>
