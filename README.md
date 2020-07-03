# Instructions for using Bookshop laravel e-commerce website

## Step 1
- You must download `composer` before run my project. For more details, see https://getcomposer.org/download/

- Clone my Bookshop project [Click here](https://github.com/quanganh991/proj2.git)

- By this statement:
 
- `git clone https://github.com/quanganh991/proj2.git`

- Create an database (create schema) named `bookshop`
## Step 2

- Make sure your web server has been turned on

- For example, if you are using `Xampp`, you have to start module `Apache` and `MySQL`

- If you are using MySQL workbench, query `Dump20200617-1.sql` in database `bookshop` without replace anything

- If you are using phpMyAdmin, in `Dump20200617-1.sql`, please find all 8 keywords `COLLATE=utf8mb4_0900_ai_ci;` and replace all of them into `COLLATE=utf8mb4_unicode_ci;` before querying in database `bookshop`

## Step 3

- Open terminal and then run ` composer install` to install all you need to run my project

- Run `cp .env.example .env` or `copy .env.example .env` to create your `.env` file

- Run `php artisan key:generate` to create your own secret project key

## Step 4

- #####In `.evn` file, there are 6 attribute need replacing:

- `DB_CONNECTION=mysql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=3306`
- `DB_DATABASE=bookshop`
- `DB_USERNAME=root`
- `DB_PASSWORD=` (Depend on your password which was set originally. For example: "`a123456A`")



## Step 5
- If you see `bumbummen99` folder in `vendor` folder, you can skip this step and go to step 6

- Run this command in terminal:

- `composer require bumbummen99/shoppingcart`

- If you see `bumbummen99` folder in `vendor` folder, that means you have installed successfully.  Vice versa, check your internet connection (or previous version of this library) and install again

## Step 6
- Go to browser, access 'localhost/X/' to enjoy Bookshop

- Where X is the folder location you have cloned this project.

- For example, my project location is `C:\xampp\htdocs\bookshop`, so X = `bookshop` and I need to access `localhost/bookshop/`

- Best browsers for this experience are Chrome, Firefox, Microsoft IE.

## Note

- Experience may not be unstable if you are using another web server instead of `xampp`. You should install `xampp` for most optimal service.
