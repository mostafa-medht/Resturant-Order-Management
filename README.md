# Restaurant-Management project

Restaurant Management project designed & developed to submit order with list of products consisting of ingredients has the following applied:-

1. Add, show ingredient and get all ingredients.
2. Charge ingredient if stock in low level.
3. Add, show product and get all products.
4. Add, show order and get all orders.
5. Fire an event to update ingredient stock after order placed.
6. Send an notification email if ingredient have low level.
7. Apply service design architecture and use event & listeners design pattern.
8. Applied SOLID principle for better clean architecture.
9. Use phpunit testing to test all added feature.

## Run the project

1. Clone repository

    ```
        1.1- git clone https://github.com/mostafa-medht/Resturant-Order-Management.git
        1.2- cd project-directory
        1.3- composer install
        1.4- npm install
        1.5- cp .env.example .env
        1.6- php artisan key:generate
    ```

2. Database
   2.1 Create database in DBMS via this query

    ```sql - mysql
        create database `resturant-management`;
    ```

   2.3 Database Configuration in .env file in application root

    ```
        DB_DATABASE=resturant-management
        DB_USERNAME=username
        DB_PASSWORD=password
        Put your database user after DB_USERNAME, and your user password after DB_PASSWORD
    ```

   2.4 Migrate & seed

    ```
        php artisan migrate
        php artisan db:seed

        or

        php artisan migrate --seed
    ```

   2.5 Run the project

    ```
        php artisan serve
    ```

   2.6 Run queue service

    ```
         php artisan queue:work
    ```
   2.7 Run migration for unit testing with sqlite

    ```
         php artisan migrate --database=sqlite
    ```
---

## Contributing

-   [Mostafa Medhat](https://github.com/mostafa-medht)

## When contributing to this repository, please first discuss the change you wish to make via issue.

## Contributing Guidelines

1. **Create** a new issue discussing what changes you are going to make.
2. **Fork** the repository to your own Github account.
3. **Clone** the project to your own machine.
4. **Create** a branch locally with a succinct but descriptive name.
5. **Commit** Changes to the branch.
6. **Push** changes to your fork.
7. **Open** a Pull Request in

---

## License

Restaurant Management project Copyright © 2022 Mostafa Medht.
