# Laravel based booking + CRM for Salon Bliss

<p align="center"><img src="readme-assets/screenshots/logo-readme.png" width="400" alt="Laravel Logo"></p>

## About the project

This project is a booking and CRM system for Salon Bliss, a fictional hair salon. The system is built with Laravel, Tailwind, Livewire.For authenication the project uses Jetstream with Livewire.

This is being developed for the requirements of a Server Side Programming module. The project is currently in development.

If you want to run this project locally, follow the [installation instructions](#installation).

## Features

-   Admin user is created using the Laravel seeder
-   Admin user can create, edit and delete employees.
-   Admin and employee users can create, edit and delete services and deals.
-   Customers can register with the site.
-   Use of middleware to grant role based access to routes.

## Screenshots

Below are some screenshots of the website.

<figure>
<img src="readme-assets/screenshots/homepage.png">
<figcaption align="center">Home Page</figcaption>
</figure>

<figure>
<img src="readme-assets/screenshots/dashboard.png">
<figcaption align="center">Admin Dashboard Page</figcaption>
</figure>

<figure>
<img src="readme-assets/screenshots/manage-deals.png">
<figcaption align="center">Manage Deals Page</figcaption>
</figure>

## Installation

The following pre-requisites are needed to run the project

-   [Composer](https://getcomposer.org/download/)
-   [Node.js](https://nodejs.org/en/download/)
-   [NPM](https://www.npmjs.com/get-npm)
-   [PHP](https://www.php.net/downloads.php)
-   [MySQL](https://dev.mysql.com/downloads/installer/) (or you can use SQLite file database)

For PHP and MySQL, [ XAMPP ](https://www.apachefriends.org/download.html) or [WAMP server](https://www.wampserver.com/en/download-wampserver-64bits/) can be used.

1.  Clone the repo

    ```sh
    git clone https://github.com/sachintha-lk/CRM-laravel
    ```

2.  Move in to the folder

    ```sh
    cd CRM-laravel
    ```

3.  Install Composer packages

    ```sh
    composer install
    ```

4.  Install NPM packages

    ```sh
    npm install
    ```

5.  Create a .env file by copying the .env.example file

6.  Generate an app encryption key

    ```sh
    php artisan key:generate
    ```

7.  Create a database and add the database credentials to the .env file

    Follow instructions from Laravel docs if you are using SQLite. https://laravel.com/docs/10.x/database#sqlite-configuration

8.  Run the migrations

    ```sh
    php artisan migrate
    ```

9.  Run the seeders

    ```sh
    php artisan db:seed
    ```

10. Run the project

    ```sh
    npm run dev
    ```

    Keep this running and open a new terminal and run

    ```sh
    php artisan serve
    ```

11. Visit the site at http://localhost:8000

**Note:** The Admin user is created using the seeder. The default credentials are as follows:<br>
email : `admin@salonbliss.com`<br>
password : `adminpassword`
