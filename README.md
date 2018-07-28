# test-twitter

## Task

Build an endpoint that returns an array with the last 10 tweets of a twitter account, respecting the following format: 
 
```json
{
    "created_at": "Mon Jun 25 16:03:38 +0000 2018",
    "text": "esto es un tweet",
    "in_reply": 
    {
        "id": 123465,
        "name": "john doe"
     }
}
```
####Params:
```
created_at : obligatorio
text: obligatorio
in_reply: si fuese una respuesta a otro usuario.
```

####Conditions

* The project should be developed using PHP 5.4+
* If necessary, you can use any web framework of your choice, We recommend SlimPHP
* You can use the data store solution of your choice if you need one
* The full project should be correctly revisioned using GIT. That GIT repository should be accesible by us (publicly or privately) on GitHub or BitBucket.
* You don't need to serve the project to the internet but it should be testeable locally using the php built-in webserver or similar solution with the proper documentation on how to do it
* Unit Tests are a big plus!
* All added value you can give to the original idea is highly appreciated

## Project

#### Folder structure
This project is built using Docker and PHP 7.2 with a DDD approach. 
This leads to three main folders: (https://en.wikipedia.org/wiki/Domain-driven_design)
* *Application*: services to interact with the domain of the application.
* *Domain*: entities, domain exceptions and interfaces to handle domain layer.
* *Infrastructure*: concrete implementations of the domain.

#### Requirements
In order to run this project you will need:

* Docker (https://www.docker.com/community-edition)
* Docker compose (https://docs.docker.com/compose/install/)

#### Local environment

* Nginx
* PHP 7.2 (FPM)
* MySQL

If you use Linux a *Makefile* is included, so you can run these commands to start and stop all containers at once.
Go to project root and run:

To start docker
```
make up
```

To stop docker
```
make down
```

#### First time instructions:

######  Linux
1) Install Docker and Docker compose
2) In project root execute ``` make up ``` 
3) In project root execute ``` make php ``` and go inside php docker.
4) Execute ``` composer install```
5) Apply database dump ``` php bin/console orm:schema-tool:update --force ```

######  Windows 10
1) Install Docker
2) In project root execute ``` docker-compose up -d ``` 
3) In project root execute ``` docker exec -it php-maxinuss-container bash ``` and go inside php docker.
4) Execute ``` composer install```
5) Apply database dump ``` php bin/console orm:schema-tool:update --force ```

#### Endpoints
###### Get tweets
Get last 10 tweets from account. 

[POST] ```/tweet/list```

Response:
```json
{
    "created_at": "Mon Jun 25 16:03:38 +0000 2018",
    "text": "esto es un tweet",
    "in_reply": 
    {
        "id": 123465,
        "name": "john doe"
     }
}
```

#### Running test
This project is tested under PHPUnit and includes a unit test suite:
```
php vendor/bin/phpunit
```
