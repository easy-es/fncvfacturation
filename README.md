# CakePHP 4.0 Application 


A light invoice and estimation bill manager in CakePhP 4 and Boostrap 4

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation
1. Download or use the command git clone  https://github.com/easy-es/fncvfacturation.git .
2. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
3. Run `php composer.phar install` or if composer is installed globally, run `composer install`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):


## Run SQL script

Run the init.sql script. You can find the file :  /config/schema/init.sql

## Import csv file

You can not import any csv file. You have to respect the structure. If the id of the data row is found , the row data is updated.

## Feature

The application can create,modify,delete an invoice.
Basic systeme loggin.
Datatable.js plugin.
Auto generation of an invoice id based on the last inserted id in the table.
Verification of the auto generated invoiced id. 
