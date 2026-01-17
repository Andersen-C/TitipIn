<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# TitipIn
TitipIn is a campus-based web platform project designed to help university students purchase food and beverages during short breaks between classes without having to visit crowded canteen or restaurant areas. 

Imagine you are in the middle of short breaks between classes, a dozen, or even hundreds of students are heading to the campus canteens and restaurants, and the campus canteens and restaurants often become overcrowded, causing long queues and inefficient use of students’ limited time.

TitipIn solves this by enabling peer-to-peer food ordering within the campus. Students who want to buy food (Titipers) can place orders through the platform, while other students (Runners) fulfill and deliver those orders. This distributed purchasing model reduces crowd concentration, speeds up transactions, and creates a smoother break-time experience for everyone.
<br>

# :star: How It Works
## Titiper (Buyer)
- Places food or beverage orders via the website
- Specifies pickup vendor and delivery location on campus
- Receives orders without leaving classrooms

## Runner (Purchaser & Courier)
- Accepts orders through the platform
- Purchases items from the selected vendor
- Delivers orders directly to the Titiper
<br>

# :bookmark_tabs: Getting Started
Follow the steps below to set up **TitipIn** on your local machine.

## Prerequisites
1. Git
2. PHP >= 8.1
3. Composer
4. Node.js & NPM
5. XAMPP or any MySQL-compatible database

## Setup Instructions
```bash
# clone this repository
git clone https://github.com/Andersen-C/TitipIn.git
cd TitipIn

# Install PHP Dependencies 
composer install

# Create a new .env file

# Copy the content of the .env.example file to the .env file

# Generate application key
php artisan key:generate

# create a new MySQL database

# Open the .env file and update the database:
DB_DATABASE=your_database_name

# Run the migrations and seeder file
php artisan migrate
php artisan db:seed

# Install Tailwindcss v4.1 and Daisy UI
npm install -D tailwindcss postcss autoprefixer
npm install daisyui

# Run NPM
npm run dev

# link the storage/app/public directory to the public directory using:
php artisan storage:link 

# Run the Laravel Development Server
php artisan serve

# Access the application via your browser at http://127.0.0.1:8000
```
<br>

## :man: Contributors
<a href="https://github.com/Andersen-C/TitipIn/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Andersen-C/TitipIn" />
</a>

Made with [contributors-img](https://contrib.rocks).
