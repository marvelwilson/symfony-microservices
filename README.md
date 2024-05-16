# Symfony Microservices Communication App 

Developed for a case study: Symfony Microservices Communication


## Setting up

```shell
git clone git@github.com:marvelwilson/symfony-microservices.git
cd symfony-microservices/
docker-compose up --build -d
```
install composer manually(User-services only)
```shell
cd user-services/
composer install
cd ..
```

```
Create database with docker or manually on phpmyadmin server (you can find that below)
```shell
docker-compose run --rm fpm php bin/console doctrine:database:create
```
Migrate database
```shell
docker-compose run --rm fpm php bin/console doctrine:migrations:migrate
```


## Funtional Testing

Then login to amqp server:
```shell  
url: http://localhost:5672
username:user
password:password
```

View phpmyadmin:
```shell
url: http://localhost:8000
username:root
password:test
```


API to create user(POST)
```Shell
url: http://localhost:1032/api/user
 
```

Object example:
```Shell
{
    "firstName":'',
    "lastName":'',
    "email":'',
}
```
From notification-services we can issue command:
```shell
docker-compose run --rm notification php bin/console messenger:consume -vv external_messages
```


As an output you should see Messages issued by notification-services.
```shell
16:46:56 INFO      [messenger] Received message App\Message\UserDataSavedEvent ["class" => "App\Message\UserDataSavedEvent"]
16:46:56 INFO      [app] User data saved: User ID: 8, Email: marvelwilsononit@text.com, First Name: Marvel, Last Name: Wilson
16:46:56 INFO      [messenger] Message App\Message\UserDataSavedEvent handled by App\MessageHandler\UserDataSavedEventHandler::__invoke ["class" => "App\Message\UserDataSavedEvent","handler" => "App\MessageHandler\UserDataSavedEventHandler::__invoke"]
16:46:56 INFO      [messenger] App\Message\UserDataSavedEvent was handled successfully (acknowledging to transport). ["class" => "App\Message\UserDataSavedEvent"]
```

## Unit/Integration Testing

Test for user-services
```Shell
docker-compose run --rm fpm php bin/phpunit tests/unit
docker-compose run --rm fpm php bin/phpunit tests/integration
```


## Unit Testing

Test for notification-services
```Shell
docker-compose run --rm notification php bin/phpunit tests/unit
```
