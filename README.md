# Rest API - Laravel

## Documentation
- [Official Documentation](https://laravel.com/docs/8.x/installation)
- [Migrations](https://laravel.com/docs/8.x/migrations)
- [Eloquent ORM](https://laravel.com/docs/8.x/eloquent)
- [Relationships](https://laravel.com/docs/8.x/eloquent-relationships)
- [Passport](https://laravel.com/docs/8.x/passport)
- [API Resources](https://laravel.com/docs/8.x/eloquent-resources)

## Prerequisites
- PHP >= 7.3
- Composer
- Web server (Apache/Nginx)
- MySQL or other supported database

## Installation

**Clone the repository**

```bash
 git clone https://github.com/ChrisN01/productsApi.git 
```

**Switch to the repository folder**

```bash
 cd productsApi
```

**Install all the dependencies**

```bash
 composer install
```

**Copy the example env file and make the required configuration changes in the .env file**

```bash
 cp .env.example .env
```

**Generate the application security Key**

```bash
 php artisan key:generate
```

**Run tha database migrations**
```bash
 php artisan migrate
```

**Database seeding**
Fill the database with seed data with relationships which includes users, products,reviews. This can help you to quickly start testing the api

```bash
 php artisan db:seed
```

**Passport Configuration**
```bash
    php artisan passport:install
```

# Testing API
```bash
    php artisan serve
```

The api can now be accessed at
```bash
 http://localhost:8000/api
 ```