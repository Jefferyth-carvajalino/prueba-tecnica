# Getting started

## Installation

Clone the repository

    git clone https://github.com/Jefferyth-carvajalino/prueba-tecnica.git

Switch to the repo folder

    cd prueba-tecnica

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations and seed data (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Jefferyth-carvajalino/prueba-tecnica.git
    cd prueba-tecnica
    composer install
    cp .env.example .env

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes categories and users. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Run the database seeder and you're done

    php artisan seed

**_Note_** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:fresh --seed

---

# Code overview

## Folders

-   `app/Models` - Contains all the Eloquent models
-   `app/Notifications` - Contains all the notifications (mail) logic
-   `app/Http/Controllers/V1` - Contains all the api controllers
-   `app/Http/Controllers/Resources` - Contains all the api resources
-   `database/factories` - Contains the model factory for all the models
-   `database/migrations` - Contains all the database migrations
-   `database/seeds` - Contains the database seeder
-   `routes` - Contains all the api routes defined in api.php file
-   `tests/Feature/Http/Controllers/Api` - Contains all the api tests
-   `resources/views` - Contains the app view

## Environment variables

-   `.env` - Environment variables can be set in this file

**_Note_** :

-   You can quickly set the database information and other variables in this file and have the application fully working.

-   You can add **Admin Email Address** in this file with like this:

    ADMIN_MAIL_ADDRESS = admin@mail.com

---

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api/v1/...

Request headers

| **Required** | **Key**      | **Value**        |
| ------------ | ------------ | ---------------- |
| Yes          | Content-Type | application/json |
| Yes          | Accept       | application/json |

---

# Cross-Origin Resource Sharing (CORS)

This applications has not enabled by default on all API endpoints. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.

-   https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
-   https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
-   https://www.w3.org/TR/cors
