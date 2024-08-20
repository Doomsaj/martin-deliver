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
