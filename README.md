## Weather application

This is an API application that read weather data from some different sources, an then generates an average weather temperature from them, for a given city.
The main goal from building this application is to improve some SOLID principles, OOP, among other things; and last but not least, implementing a pure PHP API, using no framework.

### How to run this application

To run this application, first ensure that you have both `PHP` and `composer` installed.
After clone the repo, access the containing folder and run the command below to install dependencies:

```composer install```

Before you start the server, access the directory `/public`, and then start PHP server, with the command:

```php -S localhost:8080```

By following the steps above, you'll be able to open the browser and go to `localhost:8080`, and the application should respond correctly.

### The next steps

As next step to this application is put it in a docker container, becoming easy to run independent on environment.
