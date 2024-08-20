# Martin-Deliver

## 1.API Docs

You can find API docs on [martin-deliver-api-documentation.md](martin-deliver-api-documentation.md)

## 2.Running App

### 2-1. Prerequisites

- PHP version 8.2
- redis
- docker (optional)

### 2-2. Installation

- **Application**:
  ```shell
  git clone https://github.com/Doomsaj/martin-deliver.git
  cd martin-deliver
  composer install
  cp .env.example .env
  php artisan key:generate
  touch ./database/database.sqlite
  php artisan migrate
  php artisan db:seed --class=SystemUsersSeeder
  ```
- **Redis**:
  ```shell
  docker compose up -d
  ```

### 2-3. Start Application

- **Artisan Web Server**:
  ```shell
  php artisan serve
  ```
- **Running Queue Worker**:
  ```shell
  php artisan queue:work --queue=webhook-calls,consignment_status_events,courier_location_events
  ```

## 3.Explain

This application uses sqlite as database and redis queue and lock backend.
This app have some default users:

- Client:
    - username: client
    - password: password
- Courier:
    - username: courier
    - password: password

The authentication and authorization implemented with sanctum via a simple access token.
