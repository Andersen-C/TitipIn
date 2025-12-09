<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TitipIn
Cara berkontribusi pada project TitipIn
1. Clone Repository jika belum. (jika sudah clone, maka setiap pengerjaan selalu update pull dari branch utama)
```
git clone https://github.com/Andersen-C/TitipIn.git
```
2. install seluruh dependencies
```
composer install
```
3. Buat file .env baru
4. Copy isi file .env.example ke file .env baru
5. Jalankan Apache dan MySQL pada XAMPP
6. Buat database dengan nama yang sesuai pada .env
7. lakukan migration dan seeder
```
php artisan migrate
php artisan db:seed
```
8. Install Tailwindcss v4.1 dan Daisy UI
```
npm install -D tailwindcss postcss autoprefixer
npm install daisyui
```
9. Jalankan npm
```
npm run dev
```
10. Jalankan local development laravel
```
php artisan serve
```
11. buka localhost pada browser
12. silahkan kerjakan

## Panduan Kontribusi
1. Buat branch baru (**JANGAN LANGSUNG DI MAIN BRANCH**)
```
contoh: feature\<nama-fitur>
```
2. commmit secara berkala
3. push branch ke Github
4. Buat Pull Request (PR)
5. Jika disetujui, merge ke main
