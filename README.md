# CakePHP 4.0 Application 


A light invoice and estimation bill manager in CakePhP 4 and Boostrap 4

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation
 Download or use the command git clone  https://github.com/easy-es/fncvfacturation.git .


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
All collumns are sortable.
Filter by categories.
Pagination of the number of rows shown.

## Import a csv file 
If the CSV file does not respect the file structur, the process is stop.
If the data of the file mismatch or are incorrect , none of the data are saved
If the data already exist, the data is update.
