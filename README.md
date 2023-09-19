## Requirements
- php 8.1
- composer
- tidak perlu menggunakan npm (karena hanya full backend API)

## How to run this project
- clone terlebih dahulu
- copy .env.example and rename it .env
- run : php artisan key:generate
- run : php artisan config:cache
- run : php artisan migrate
- run : php artisan db:seeder ProfesiSeeder
- run : php artisan db:seeder JenisKelaminSeeder
- run : php artisan serve

- open postman :
    - endpoint save user from api random user : 
        GET : 127.0.0.1:8000/api/v1/random-user/get-user
    
    - endpoint profesi : 
        GET : 127.0.0.1:8000/api/v1/random-user/profesi
    
    - endpoint get all users : 
        GET : 127.0.0.1:8000/api/v1/random-user