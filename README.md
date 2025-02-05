
## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/mvtdev1050/tickets-sytem-test-task.git
    ```
2. Navigate to the project directory:
    ```bash
    cd your-repository

3. Run docker build command
    ```bash
    docker compose build --no-cache
    ```
4. Run docker up commad
    ```
    docker compose up
    ```
5. Project will run on -
   laravel : http://ip
   Vuejs: http://ip:5173

## Mongodb Database

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

# Ticket CRUD API

This API allows users to perform CRUD (Create, Read, Update, Delete) operations on tickets. It provides endpoints to create, retrieve, update, and delete tickets.

## Base URL

{baseurl}/api

## API Endpoints

### 1. **Get All Tickets**
   - **Endpoint**: `/ticket`
   - **Method**: `GET`
   - **Description**: Retrieves a list of all tickets.


### 2. **Get Ticket For Edit**
- **Endpoint**: `/ticket/edit/{id}`
- **Method**: `GET`
- **Description**: Fetches the details of a specific ticket for editing by its ID.

### 3. **Create New Ticket**
- **Endpoint**: `/ticket/add`
- **Method**: `POST`
- **Description**: Creates a new ticket.
- **Params**:`title,description,status`

### 4. **Update Ticket**
- **Endpoint**: `/ticket/update/{id}`
- **Method**: `PUT`
- **Description**: Updates an existing ticket by its ID.
- **params**:`title,description,status`

### 5. **Delete Ticket**
- **Endpoint**: `/ticket/delete/{id}`
- **Method**: `DELETE`
- **Description**: Deletes a specific ticket by its ID.



