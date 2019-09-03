PING-PONG-SERVER
==========================

## Introduction
It is based on the dockerized yii2
app found at [dmstr's GitHub Repository](https://github.com/dmstr/docker-yii2-app)


## Requirements

- [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
  - Docker `>=1.10`
  - docker-compose `>=1.7.0`


It is based on the dockerized yii2

## Server setup
 - Install Docker and docker compose for the platform you're running
 - run `docker-compose up -d` in the root of this repository
 - run `docker-compose exec web bash` to enter the shell of the docker container; execute the following sub-steps in the shell:
    - run `composer install` to install Yii2
    - run `php yii migrate` to execute database migrations

## Develop

Create bash    
    
    docker-compose web php bash

Run package update in container    
    
    $ composer update -v

...

    $ yii help
    
 # Running Automated Tests
To run the automated tests you need to set up your Docker container:

`docker-compose up -d`

The line above (among other work) will create the `selenium` container in Docker which runs the Selenium server and ChromeDriver used by the acceptance tests.

Enter the shell of the web server:

`docker-compose exec web bash`

To run all the tests, type:

`vendor/bin/codecept run`

Or if you want to run only one test suite, for example "unit", type:

`vendor/bin/codecept run unit`

      
## Test

    cd tests
    cp .env-dist .env

Run tests in codeception container
      d
      docker-compose exec web codecept run
          
> :info: This is equivalent to `codecept run` inside the tester container          
  

### CLI
    
    docker run dmstr/yii2-app yii


## Resources
   
- [Yii 2.0 Framework guide](http://www.yiiframework.com/doc-2.0/guide-index.html)
- [Yii 2.0 Docker Images](https://github.com/yiisoft/yii2-docker)
- [Docker documentation](https://docs.docker.com)

    

