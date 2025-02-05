# Project Title

A brief description of what your project does.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/your-repository.git
    ```
2. Navigate to the project directory:
    ```bash
    cd your-repository

3. Run docker build command
    ```bash
    docker compose build
    ```
4. Run docker up commad
    ```
    docker compose up
    ```

## create DB in mongodb
1. Check mongodb contain ID
    ```
    docker ps
    ```
2. Run bash command
    ```
    docker exec -it <container-id> bash
    ```
3. Now open mongo shell with
    ```
    mongo
    ```

4. You can create database here by 
    ```
    use database laraveltest
    ```

## To Run laravel migrations

1. sudo docker-compose exec php php artisan migrate
