## Main

This is test project with minimum facilities for making order by customers.
This repo has two branches: master and develop.

•	Author: rk-pol 

## Requirements
•	PHP 8.0 or higher 
• 	Mysql

## Usage <br>
Setting up your development environment on your local machine: <br>
```
git clone git@github.com:rk-pol/test-ecom.git
composer install
php artisan key:generate
php artisan serve
```


## Before starting <br>
Create a database <br>
```
mysql
create database laravel;
exit;
```

Setup the database credentials in the .env file <br>

Database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME={USERNAME}
DB_PASSWORD={PASSWORD}
```
Mail:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=testmailsendler81@gmail.com
MAIL_PASSWORD=azpfkabyyuyzmioe
MAIL_ENCRYPTION=ssl
```

Migrate the tables
```
php artisan migrate
```	

Seed the tables
```
php artisan db:seed
```	
## Additional information <br>
Authentication<br>

While seeding, are being created two pairs for authentication with admin and common user's roles.

Admin login credentials:
```
email:  admin@example.com
password: admin
```
User login credentials:
```
email: user@example.com
password: user
```
