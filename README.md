# Challenge - Strategy

## What is the Strategy challenge?
The challenge asks to implement a system using the Strategy pattern to display different messages according to the day of the week. As an increment, an API was added that will show if that day is a national holiday or not.

In the end, a scheduling API was developed based on the idea of the application.


## Install dependencies
```sh
# To clone the project
git clone: https://github.com/GenoaroSJr/project-strategy.git

# Go to the project directory
cd project-strategy/back-end

# Install dependencies
composer update
```

## Configuring database
```sh
# Configure config/db.php: 
private $host = 'your host name';
private $user = 'your user';
private $pass = 'your password';
private $dbname = 'strategy-db';

# Run migration:
The file to create the database with the necessary fields is MigrationDB.sql

The database is configured!
```

## Run project 
```sh
# Start the server:
composer start

# See the project:
http://localhost:8080

A message like "Essa API foi desenvolvida como critério de aceite para área de desenvolvimento, back-end, da empresa INCLUIR TECNOLOGIA." should appear
```

## The API collection
/collection/Collection API Teste Mova.postman_collection





