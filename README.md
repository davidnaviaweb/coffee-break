<p align="center">
<a href="https://coffeebreak.davidnaviawe.com" target="_blank">
<img src="https://raw.githubusercontent.com/davidnaviaweb/public/main/img/LogoCoffeeBreak.png" width="100" alt="Laravel Logo">
</a>
</p>

# About Coffee Break

Coffee Break is a Laravel-based project that serves as a backend for an application written in Java. This application is
designed to manage the functionality of a beverage vending machine and is part of the project developed for the
subject "Computer Science Project" of the second year of the Degree in Computer Engineering at the Universidad Europea.

The project has been developed by:

- [David Navia](https://github.com/davidnaviaweb)
- [David Cachero](https://github.com/davidcachero)
- [Jesús de Francisco Granda](https://github.com/ChusUEM)
- [Víctor Álvarez](https://github.com/vicex99)
- [José Luis Blázquez](#)

## Requirements:

- PHP 8.1 or higher
- Any SQL database engine (recommended MySQL/MariaDB)
- Composer
- NPM

## Setup

After downloading the project, follow the next steps:

1. Install the dependencies via `composer`:

   `composer install --dev`


2. Generate the unique key of the project:

   `php artisan key:generate`


3. Using the file located in the root of the project `.env.example` as a template, create the `.env` file, and modify it
   according to the configuration of your development environment.

The most important sections to review are:

- The name of the application: *Coffee break*.
- The application path: you can leave it as it is or configure a local Virtual Host.
- The database configuration: type, host, name, user and password. **NOTE: Do not forget to create the database**
- Change the `FILESYSTEM_DISK` to `public`
- Change `MAIL_HOST` to `localhost` (check [Mail](https://github.com/davidnaviaweb/coffee-break#mail) section below)

Then, to follow up the installation of the project, the necessary commands have to be executed to populate the database with
test data and compile the necessary assets:

`php artisan migrate --seed`

`npm install`

`php artisan storage:link`

Finally, if you have not set up a local Virtual Host, you can run the application with the command:

`php artisan serve`

Also, for live updating of the changes, start the Vite server with:

`npm run dev`

## Contributing

Please follow the [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) guidelines when contributing.
Thank you

## Mail

The project uses [Mailpit](https://github.com/axllent/mailpit) to serve as mail fake server. Once installed and running,
**Mailpit client** can be found in (http://localhost:8025)


