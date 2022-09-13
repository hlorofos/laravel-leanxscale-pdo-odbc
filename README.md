# LeanXcale ODBC integration for Laravel Framework


## # How to install

> `composer require hlorofos/laravel-leanxscale-pdo-odbc`

By default, the package will be automatically registered via the `package:discover` command.

**Manual register service provider in app.php file**

```php
'providers' => [
  ...
  LaravelPdoOdbc\ODBCServiceProvider::class
];
```

## # Configuration


It's very simple to configure:

**Add database to database.php file**
There are multiple ways to configure the ODBC connection:

Simple via DSN only:

```php
'odbc-lean' => [
            'driver' => 'leanxcale-odbc',
            'dsn' => env('DB_HOST', 'localhost'), // 'Driver={Your ODBC Driver};Server=leanxcale.example.com;Port=1529;Database={DatabaseName}',
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
]
```

> Note: DSN `Driver` can be a absolute path to your driver file or the name registered within `odbcinst.ini` file/ODBC manager.

## # Eloquent ORM

You can use Laravel, Eloquent ORM and other Illuminate's components as usual.

```PHP
# Facade
$books = DB::connection('odbc-connection-name')->table('books')->where('Author', 'Abram Andrea')->get();

# ORM
$books = Book::where('Author', 'John Doe')->get();
```
