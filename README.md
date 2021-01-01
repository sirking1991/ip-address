## About

This application allows users to create & update IP addresses. Each action done to the IP address (create & update) are log and can be view by the user.

The user interface is simple and uses the Laravels Breeze for authentication and UI starter layout.

Once the user is logged in, they will be presented with the list of IP address on the record.

The user can then click on the `Add New` button to open a dialog box to add new IP address record.
Once the IP address has been create, it can then be edited by clicking on its row. This should open a dialog box with the field prepopulated.

## Installation & Setup

Installation is simple and easy. Just follow the steps below

### Requirements:
* PHP 7.3+
* mysql or sqlite3 (either can be use). 
### Steps:
* Pull the code from the repository
* Execute `cp .env.example .env`  Note: The .env.example contains settings for sqlite. If you want to use mysql, you must provide the server credentials in .env file.

* Execute `php artisan migrate:fresh --seed`
* Execute `php artisan serve`
* You should now be able to open the app in the IP provided by the command above.

## How to test
The application was build following Test Driven Developmnt (TDD). Test were created and can be run with `php artisan test`