# Larasocket - a web socket server build with laravel and swoole

##Screenshot
![enter image description here](https://github.com/lamoimage/larasocket/blob/master/src/screenShots/larasocket.png)

## Installation

Make sure you have the SWOOLE PHP package installed. You can find installation instructions at http://pecl.php.net/package/swoole and http://www.swoole.com

run below command to install swool extension and add "extension=swoole.so" to php.ini.
```bash
pecl install swoole
```
Now pull in Larasocket package through Composer.

Run `composer require lamoimage/larasocket`

And then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'providers' => [
    Lamoimage\Larasocket\LarasocketServiceProvider::class,
];
```

## Usage

Start the socket service with `php artisan socket:start` command

```bash
php artisan socket:start
```

Then access the route `/larasocket` in browser:

If you are using homestead, the url looks like

`http://homestead.app/larasocket`


You may also do socket:stop/socket:restart to shutdown or restart the socket service.

- `php artisan socket:stop`
- `php artisan socket:restart`


If you need to modify the flash message partials, you can run:

```bash
php artisan vendor:publish
```
The SWOOLE config file will now be located in the `config/larasocket.php`.