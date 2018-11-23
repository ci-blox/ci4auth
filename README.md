# CI4Auth - A simple CodeIgniter 4 starter 

## What is in CIAuth?
1. **CodeIgniter 4** (in alpha release) is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

2. ** PHPAuth ** is a secure, well-rounded PHP Authentication class [documemtation here](https://github.com/PHPAuth/PHPAuth/wiki/Class-Methods).

3. ** Bootstrap 4 **, with basic themes, prebuilt authentication screens and secure area ( /secure )

## Installation Notes
(better instructions coming soon)
- clone this library
- run composer install
- note: we DO NOT include CI4, composer WILL INSTALL IT NOW
- migrations included to create tables: once your database and config are setup, 
  then run the Auth migrations:  php spark migrate:latest -all


## Contributing
We **are** accepting contributions from the community.

## Server Requirements
PHP version 7.1 or higher is required, with the 'intl' extensions installed and enabled
