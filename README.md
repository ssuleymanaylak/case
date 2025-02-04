## Environment Setup for the Latest Version of Laravel (PHP, Nginx, Laravel, MySql) Using Docker

### Project Structure

- `docker` - Folder for all configuration files for docker and other services
    - `nginx` - Folder for nginx configuration files
    - `php` - Folder for php configuration files
- `src` - Folder where the project code will be stored
- `mysql` - Folder where mysql will be stored
- `docker-compose.yml` - Docker compose configuration file

### Step-by-Step Guide

- Run this command
  
  ```
  mkdir mysql
  ```

#### 1. Build the Project Using Docker Compose

- Run this command
  
  ```
  docker compose build
  ```

#### 2. Create a Laravel Project

-  Run this command:

- After running this command, the project code should appear in the src folder.

- Start docker containers

  ```
  docker compose up -d
  ```

  ```
  docker-compose run --rm composer composer install
  ```
- You can verify if the project is working by opening the browser. For example, if it’s set to 81:

  ```
  http://localhost:81
  ```

#### 3. Configure Laravel project 
 
- Configure Mysql in /src/.env . Uncomment and change:

  ```
  DB_CONNECTION=mysql       # connection name, we use mysql
  DB_HOST=mysql             # name of mysql service in docker-compose.yml
  DB_PORT=3306              # mysql standart port 
  DB_DATABASE=laraveldb     # database name from MYSQL_DATABASE in docker-compose.yml
  DB_USERNAME=laravel       # username from MYSQL_USER in docker-compose.yml
  DB_PASSWORD=secret        # user password from MYSQL_PASSWORD in docker-compose.yml
  ```
- Restart all services
  
  ```
  docker compose down
  docker compose up -d
  ```

#### 4. Run Migrations

  ```
  docker-compose run --rm php php artisan migrate
  ```

#### 5. Run Seeds

  ```
  docker-compose run --rm php php artisan db:seed
  ```

#### Some useful commands

- Enter the php container (php is the name of the service from docker-compose.yml)

  ```
  docker compose run --rm php /bin/sh
  ```

- If access Forbidden

  ```
  docker compose run --rm php /bin/sh
  chown -R laravel:laravel /var/www/html
  ```
