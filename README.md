
# Gmbling dot com

I have designed, developed, and containerized a MVC for a simple web page application using Laravel and Docker.

I have created a docker conatiner using laravel sail. 

The IP address for the project is:

`0.0.0.0`

Visit the address above for a mock page with the list of affiliates.



## Installation


You will need to have composer and php 8.1 or greater installed and docker.
Make sure docker is running before running commands below in order.

DO:
```bash
Composer Install

php artisan sail:install

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

sail up

sail php artisan migrate -seed

```
Make sure the "Gambling.com - affiliates.txt" file is in the storage/app/public folder with no name changes.

## Running Tests

To run tests, run the following command

```bash
  sail php artisan test
```

# gmbldotcom
