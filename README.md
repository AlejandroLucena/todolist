# Technical test

# Part 1: PHP and Laravel

## Task:

Develop a RESTful API with Laravel for a task management system (To-Do List). The
API should enable:

1. Creating, listing, updating, and deleting tasks. [x]
2. Assigning tasks to users and altering their status (pending, in progress, completed).[x]
3. Authenticating users with API tokens.[x]

## Requirements:

1. Use migrations to establish the necessary MySQL tables.[x] 
2. Implement Middleware for authentication.[x] 
3. Adhere to SOLID principles wherever applicable.[x] 
4. Compose unit and integration tests.[x] 

## Development Briefing

I have applied DDD with CQRS. I know that could be a overengineering for this kind of task but I would like to apply as much knowledge as I could. 

Apart of appllying SOLID, I have used some design patters like Repository, Value Object, ...

The app schema is a Laravel normal APP plus some special directories.

```
|---|
|---> app/Html/Controllers/Api/V1/
|
|---> src < DDD Arquitecture Application, Domain, Infra > by Context (in this case Task and Shared)
|---> tests < Unit and Feature Tests>

```
Other folders

- docker: containes all the config needed for run the containers
- postman: contains postman collection to importo in postman

# Initialize Project
to start the project and containers
```
$ make up && start
```
to run the tests
```
$ make test
```

# Part 2: MySQL

## Task:

Craft the database schema for the task management API.
Requirements:

1. Design necessary tables with indexes and foreign keys. [x] 
2. Provide a SQL script for creating the schema. [x] 
3. Detail your approach to database migrations and versioning. [x] 

## DB Briefing

Schema for this Test is following the standars of Laravel to simplify the development.

- table for tasks (tasks)
- table for users (users)
- table related with Sanctum (personal_access_toke)
- table to relate tasks and users (task_users) this will allow us to have a N-M relation btw users and tasks. If we add a new column like 'role' we could have an owner of the task, viewer, code reviewer, tester ( following Jira for example)

to run the migrations
```
$ make reset_db
```

# Part 3: Docker

## Task:

Construct a dockerized environment for the application.

## Requirements:

1. Draft a Dockerfile for the application.
2. Compose a `docker-compose.yml` that orchestrates the application and MySQL database.
3. Ensure straightforward environment setup and execution.

Run this to start the containers and the project. It will  run MariaDB (mysql), Nginx(nginx), App(php
), sqlite. Second step is run the migrations for the DB.
```
$ make up && start
```
to stop the project
```
$ make stop
```
to stop the containers
```
$ make down
```

# Part 4: JavaScript and CSS

## Task:

Develop a rudimentary user interface to interact with the task management API.

## Requirements:

1. Employ vanilla JavaScript (or a chosen framework/library) for API interaction. [x]
2. Fashion a functional HTML/CSS interface that facilitates all API operations. [x]
3. Confirm that the interface is responsive and user-friendly. [x]

## Development resumen

We can visit this url
```
http://localhost/tasks
```

HTML/CSS implemented with Tailwindcss, that provide a mobile first view and ensure that is responsive and up to date.

Vanilla JS used to create the requests to login and create the Task

## Deliverables:

1. A GitHub code repository with `README` instructions for installation and operation. [x]
2. Comprehensive API documentation. [x]
3. API call examples utilizing `curl` or Postman. [x]
4. Database schema and elucidations as comments in the provided SQL script. [x]

# Repository
```
https://github.com/AlejandroLucena/todolist
```

# API Documentation
```
make up && start
```

to autogenerate OpenApi documentation (I worked with yaml files manually in the past) I found this very usefull
```
$ make openapi
```
and thenk you got to http://localhost/docs
Magic!
NOTE: https://laravel-news.com/automating-your-openapi-documentation

# Postman

Postman collection in

```
~/postman/clinic_cloud.postman_collection.json
```

I have implemented JWT for Auth requests. So we need to follow this flow.

- register a user
- login with the user
- make request to Task folder

Note: The DB is empty if we need to reset it just run *make reset_db*
Note 2: JWT is implemented and Bearer Token is autofilled after login or refresh

## Extra stuff

More MAKEFILE

for coding and reset the php container
```
$ make restart_php
```
to clean the files using PINT https://laravel.com/docs/10.x/pint CS-Fixer
```
$ make pint
```
to static analysis in PHP https://github.com/nunomaduro/larastan
```
$ make phpstan
```
[NOTE: I didn't invest time to fix the issues that appear maybe when I join the team ? ;) ]

