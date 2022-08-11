# Text analyzer

You can run project via docker-compose (docker and docker-compose need to be [installed](https://docs.docker.com/get-docker)]):
```
docker-compose build
docker-compose up -d
```

Go to php container and install all dependencies:
```
docker exec -it php_container bash
composer install
```

To check the task, you need to open next url in your browser: 
`http://localhost:8080/text`
Fill form with some text and submit it. 