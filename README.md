## How to start up the project

1. Clone the repository
2. Open terminal and run

```
    sudo docker compose up --build -d
```

3. Give permission to the application

```
    sudo docker compose exec -it app chmod -R 777 storage/ bootstrap/cache/
```

4. Migrate the tables just in case

```
    sudo docker compose exec -it app php artisan migrate
```

4. Open browser and go to [localhost:8000](http://localhost:8000)

## How to interact with the container if you want to run commands such as `php artisan migrate`

-   Open terminal and run

```
    sudo docker compose exec -it app bash
```

You are now inside the container and you can now run commands in it
