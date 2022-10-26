## Installation

For these instructions I assume you have a development server on your local machine.
If you don't the below could differ a bit especially in the area of URL for navigation.

1. Clone this repository
1. Run composer install
1. Create and fill the .env file (example included /.env-example)
1. Run `php artisan migrate` to create database tables
1. Seed the database by running `php artisan db:seed`
1. Seed the database by running `php artisan db:seed --class=SpecialAdminSeeder`. This command will create a default Admin account with super abilities such that you can then log in. The credentials are below
1. Run `php artisan storage:link`

1. Visit http://your-backend/login and happy surfing

Login details: mekus600@gmail.com / password

> Please note that for better experience the default Symbols created should be deleted and new symbols should be uploaded that truly contains image(s). This is because the service that Faker uses in generating images is down, thus no image will actually be generated which may affect the UI and UX of the game