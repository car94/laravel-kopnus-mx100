MX100 adalah job portal yang menghubungkan perusahaan (employer) dengan freelancer/part-timer.
Perusahaan dapat membuat & mempublish pekerjaan, sementara freelancer dapat melihat pekerjaan yang sudah dipublish dan mengirimkan CV.

Project ini dibangun menggunakan:

-   Laravel 12
-   MySQL (via XAMPP)
-   Sanctum (Token Authentication)
-   RESTful API
-   Role-based Access (Employer / Freelancer)

## Setup

1. clone repository
2. copy .env.example to .env
3. Sesuaikan database:
   DB_DATABASE=laravel_kopnus
   DB_USERNAME=root
   DB_PASSWORD=

4. Install composer dependencies:
   composer install

5. Generate app key:
   php artisan key:generate

6. Jalankan migrasi & seeder:
   php artisan migrate --seed

7. Buat storage symlink
   php artisan storage:link

8. Import postman-collection.json to postman
