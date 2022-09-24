## XM PHP Exercise v21.0.3

## Introduction

This application has three parts
<pre>
1-Form to enter data for which historical data is required
2-Historical Information visualization using Chartsjs and DataTables
3-Sends Email for the data requested.
</pre>
Technologies and plugins used in this application are 
<pre>
1-Laravel 9
2-PHP 8
3-MySql
4-Laravel Mailer
5-Datepicker
6-Chartsjs
7-DataTables
</pre>
## Flow of Application

The normal flow of application is as follows
<pre>
1-Index -> Historical Data Form which inputs values which are further passed through client side and server side validations.
2-Once the validations are addressed correctly an email is dispatched to the email provided with the request details I.e. date range and company name. Email is being sent using laravel Mail function.
3-After this the process continues and moving forward make an HTTP request using Guzzle to get the data from X-Rapid Api. After data is received it is organised according to the date ranges specified and is returned to the view.
4-In the view data is populated in dataTable -> DataTable is used to provide basic functionalities related to sorting, searching, pagination etc.
5-In the view, data related to open and close values is mapped on multi line chart to give a clear representation of data.
</pre>
## Notes
<pre>
1-Before migration please create database with database name -> “xm-task”
2-Migrations have been added for the queuing of mails
3-Currently my mailtrap credentials are available in .env file please replace them in order to use it properly.
</pre>
