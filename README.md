Catalyst Global Job Applicant Screening
==========================

## Introduction

This is an internal project used by Catalyst Global for job applicant screening. It is based on the dockerized yii2
app found at [dmstr's GitHub Repository](https://github.com/dmstr/docker-yii2-app)


## Requirements

- [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
  - Docker `>=1.10`
  - docker-compose `>=1.7.0`


## Setup

Start stack

    docker-compose up -d

Show containers

    docker-compose ps

Run composer installation

    docker-compose run --rm php composer install


## Develop

Create bash    
    
    docker-compose web php bash

Run package update in container    
    
    $ composer update -v

...

    $ yii help

      
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

    
---

#### Modified by Catalyst Global, Originally Built by [dmstr](http://diemeisterei.de)
