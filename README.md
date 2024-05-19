
## Docker setting


#### Dockerfile and docker-compose.yaml for
    apache
    php
    MariaDb
    Mysql
    phpMyAdmin

    Note: I used different ports to allow both containers to be used simultaneously 

<br>

##### Create network
    docker network create apachephp-net

##### Create image for php-apache
    in php-apache folder
    docker buildx build -t php:8.3.7-apache .

##### Setings in yaml files
    volumes folder of source php code
    change ports number if you needed

##### Run container for mariadb
    in img-databases folder
    docker-compose -f ./docker-compose.mariadb.yaml up --build

    work on:
    phpmyadmin http://127.0.0.1:8080/
    phpapp http://127.0.0.1:8090/

##### Run container for mysql
    in img-databases folder
    docker-compose -f ./docker-compose.mysql.yaml up --build

    work on:
    phpmyadmin http://127.0.0.1:8081/
    phpapp http://127.0.0.1:8091/

##### Php connection parameters
    In pdoconn.php you can see an example
