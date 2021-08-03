# TotallyNotNetflix
Small Symfony-based Video Rental WebApp

### How to run it

This being a simple Symfony web application, the only steps required to run it, are:
* Clone the Repo
* With your terminal in the repo's directory, run ```composer install```
* Edit the .env file, to input your OMDB API Key if you want to use yours, and adjust the connection string to the Database. By default it's a MariaDB database connecting to 'stardust' as 'stardust'@'localhost', with the password Twoseven3
* After this, perform the 3 migrations running ```php bin/console doctrine:migrations:migrate``` three times. (One for each)
* Load up the Data Fixtures, by running ```php bin/console doctrine:fixtures:load```, that way we'll have a small set of data.
* Start up the server with ```symfony server:start```