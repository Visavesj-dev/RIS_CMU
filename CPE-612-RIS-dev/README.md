# CPE-612-RIS
This is repositiry of ris.eng.cmu.ac.th

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install before start working

- Docker >2.0.0
- Docker Compose

### Start Development

0. Config Git to use LF (Required for Windows)

```
git config --global core.eol lf
git config --global core.autocrlf input
```

1. Clone Project. 

```
git clone https://github.com/chaiyr/CPE-612-RIS.git
```

2. Move to project's directory.

```
cd CPE-612-RIS
```

3. Copy and **CONFIG** your env file

```
cp .env.example .env
```

4. Lets compose some container.

```
docker-compose up -d
```

5. Attach to php-fpm container

```
docker-compose exec fpm bash
```

  1. Install Laravel Dependencies

```
composer install
```
  2. Generate App Key

`
php artisan key:gen
```

  3. Migrate Database

```
php artisan migrate --seed
```

6. The Project is Ready.

RIS App: http://localhost:8080
PHPMyadmin: http://localhost:8888
default username: risuser
default password: rispasswd

### Stop Working

```
docker-compose stop
```

### Continue to work

```
docker-compose start
```

### Reset Database

```
docker-compose down
docker-compose up -d
```

### How to refresh database
in fpm container
```
php artisan migrate:refresh --seed
```

#### If migration failed bacuase of some migration class is missing.
1. Open phpmyadmin then drop all tables inside `ris` database.

2. In fpm container. Migrate new database
```
php artisan migrate --seed
```
