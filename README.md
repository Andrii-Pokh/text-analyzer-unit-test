# Text analyzer unit tests

You can run project via docker-compose (docker and docker-compose need to be [installed](https://docs.docker.com/get-docker)]):
```
docker-compose build
docker-compose up -d

```

Go to php container and install all dependencies:
```
docker exec -it php_container sh
composer install
```

To check the task, you need to run tests inside docker:
```
php bin/phpunit
```
Now cross the fingers and wait until all the tests will be green. 