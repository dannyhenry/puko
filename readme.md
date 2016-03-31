# Puko - V0.93 Beta [![Build Status](https://travis-ci.org/Velliz/puko.svg?branch=master)](https://travis-ci.org/Velliz/puko)

Puko is the Micro Model-View PHP Framework for faster PHP application Development.

*Puko Require* **PHP 5.3** *or greater*

## Features

**URL Routing**

Basic URL routing follows these rules:
```
localhost/[controller]/ "will search method and view with name 'main'"
localhost/[controller]/[function]/
localhost/[controller]/[function]/[var1]/[var2]/[var3]/...
localhost/[controller]/[ID]/[function]/[var1]/[var2]/[var3]/... "ID accepts [0-9] only"
```
**Data Access**

Database Access can configure via **Config/db.php** and you can use static **Data.php** class to perform CRUD operations like:
```
Data::To("table name")->Save($arraydata); "insert"
Data::To("table name")->Update($arraywhere, $arraydata); "update"
Data::To("table name")->Delete($arraydata); -> "delete"
Data::From("your query here")->FetchAll(); -> "select"
```
**Template Engine**

Puko use **.html** file for view. So if you want to do styling or scripting:
```
<!--@css{bootstrap.min,datatable}-->
<!--@js{jquery.min,datatable.min}-->
```
And the **.html** file has always have their partners. **.css** and **.js** located in Assets

For data Boilerplates, you can print data returned by Controller class like this:
```
{!value} "print simple single value"
{!loop} {!value} {/loop} "print value on array"
{!!condition} {/condition} "blocked condition"
```

## TODO
- Adding support for handle wrong or not find URL routing path or 404 Not Found Pages
- Adding support for another Database Connection (Oracle, SQL Server)
- Adding Session and Cookies Support (also remember me)
- Adding dynamic url for view in Template Engine
```
<!--@url{[controller]/[function]}-->
```
- Adding PDO database tweaks for commit and rollback database transaction
- Adding support for Exception in Template Engine
```
{!!PukoException}
  {!Messages}
{/PukoException}
```

## About

Crafted with <3 from **Bandung**, Indonesia.

## Contributing

If you find bugs error or you want contribute to this project. 

just send me email to : diditvelliz@gmail.com 

Thanks :)
