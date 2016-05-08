## TODO
- Adding support for another Database Connection (Oracle, SQL Server)
- Adding Authorization and Cookies Support (also remember me)
- Adding dynamic url for view in Template Engine
```HTML
<!--@url{[controller]/[function]}-->
```
- Adding PDO database tweaks for commit and rollback database transaction
- Adding support for Exception in Template Engine
```PHP
{!!PukoException}
  {!Messages}
{/PukoException}
```

## Changelog

**v0.1**
- Build support for PHP template engine ~~Actualy this is my test result in Maranatha Christiant University for Backend Developer~~

**v0.5 Alfa**
- Build support for PDO Database Connection
- Build support for URL REST style routing

**v0.7 Alfa**
- Build support for Micro Model-View style code and Class Autoloader
- Build support for Combining URL REST and Template Engine

**v0.9.1 Beta**
- Add more human-readable error message

**v0.9.2 Beta**
- Fix controller constructor id variable value error
- Build support for PDO Database delete function
- Build css and js template renderer feature
- Repositioning view hierarchy
- Adding support to PDO datatypes handling like BLOB data objects and Date data objects

**v0.9.3 Beta**
- Add support for output type in Controller.
```PHP
class Example extends View {
```
Puko will render this controller with HTMLParser. Will result HTML page
```PHP
class Example extends Service {
```
Puko will render this controller with JSONParser. Will result JSON page
- Adding support for handle wrong or not find URL routing path or 404 Not Found Pages (PRODUCTION MODE)
- Adding support for session via PukoAuthObject->IsAuthenticated()
- Adding support for master html layout template engine
- Adding Model class
