#### virtual-doctor

#### READY FOR USE!
- [About](#about)
- [Features](#features)
- [Installation Instructions](#installation-instructions)
    - [Optionally Build Cache](#optionally-build-cache)
- [Seeds](#seeds)
- [Routes](#routes)
  - [Authentication Routes](#authentication-routes)
  - [Profile Routes](#profile-routes)
  - [Admin Routes](#admin-routes)
- [Other API keys](#other-api-keys)
- [Environment File](#environment-file)

### Installation Instructions
1. Run `sudo git clone https://github.com/KeithNdhlovu/virtual-doctor.git virtual-doctor`
2. Create a MySQL database for the project
    * ```mysql -u root -p```
    * ```create database virtual-doctor;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `sudo composer update` from the projects root folder
9. From the projects root folder run `sudo chmod -R 755 ../virtual-doctor`
10. From the projects root folder run `php artisan key:generate`
11. From the projects root folder run `php artisan migrate`
12. From the projects root folder run `composer dump-autoload`
13. From the projects root folder run `php artisan db:seed`


#### Optionally Build Cache
1. From the projects root folder run `php artisan config:cache`

### Seeds
1. Seeded Roles
  * Doctor
  * User
  * Administrator
  * Pharmacy Administrator

2. Seeded Permissions
  * view.users
  * create.users
  * edit.users
  * delete.users

3. Seeded Users

|Email|Password|Access|
|:------------|:------------|:------------|
|user@user.com|password|User Access|
|admin@admin.com|password|Admin Access|

### Environment File

Example `.env` file:

```
APP_ENV=local
APP_KEY=base64:cZZtOyoYc4AT7x1MJDI7Z1QFIlKa91Y6oEwMCKk3Lkk=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost
APP_NAME="Virtual Doctor"

MYSQL_PORT_3306_TCP_ADDR=mysql
DB_CONNECTION=mysql
DB_DATABASE="virtual-doctor"
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_FROM_NAME="Virtual Doctor"
MAIL_FROM_ADDRESS=postmaster@virtual-doctor.co.za

DEBUG_BAR_ENVIRONMENT=local

```

#### Laravel Developement Packages Used References
* http://laravel.com/docs/5.5/authentication
* http://laravel.com/docs/5.5/authorization
* http://laravel.com/docs/5.5/routing
* https://laravel.com/docs/5.5/migrations
* https://laravel.com/docs/5.5/queries
* https://laravel.com/docs/5.5/views
* https://laravel.com/docs/5.5/eloquent
* https://laravel.com/docs/5.5/eloquent-relationships
* https://laravel.com/docs/5.5/requests
* https://laravel.com/docs/5.5/errors

* Tree command can be installed using brew: `brew install tree`
* File tree generated using command `tree -a -I '.git|node_modules|vendor|storage|tests`

### Virtual Doctor License
Virtual Doctor is licensed under the MIT license. Enjoy!