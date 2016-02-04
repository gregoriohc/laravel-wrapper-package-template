# Laravel 5 Wrapper Package Template

Based on https://github.com/cviebrock/laravel5-package-template

See an example of use on https://github.com/gregoriohc/laravel-trello

## Installation

Clone this repo with minimal history using your choosen package name:

```sh
git clone --depth 1 git@github.com:gregoriohc/laravel-wrapper-package-template.git my-package
```

Re-init it as your own package:

```sh
cd my-package
rm -rf .git
git init
```


## Configuration

The template files provide a scaffold for building your own package.  You'll need to make a bunch of changes to the provided files to make it your own.


### composer.json

Edit `composer.json` to reflect your package information.  At a minimum, you will need to change the package name and autoload lines so that "vendor/package" reflects your new package's name and namespace.

```json
{
    "name": "vendor/package",

    "autoload": {
        "psr-4": {
            "Vendor\\Package\\": "src/"
        }
    },

},
```

Also, include the PHP library you want to wrap. Ex.:
```sh
composer require vendor/awesome-php-library
```


### config/packagename.php

Rename `config/packagename.php` to something more useful, like `config/my-package.php`.  This is the configuration file that Laravel will publish into it's `config` directory. The included configuration variables are just an example and they can be removed.


### src/PackageServiceProvider.php

Rename `src/PackageServiceProvider.php` replacing `Package` for your own package name and open it up as well.  At a minimum you'll need to change the class name and the namespace at the top of the file (it needs to match the PSR-4 namespace you set in `composer.json`).

In the `register()` method, change the "packagename" app array index to your package name and also the "MyFacade" alias to the name of the Facade you want to use to access your wrapper:

```php
//...
$this->app['packagename'] = $this->app->share(function($app) {
    return new Wrapper($app['config']);
});

$this->app->alias('MyFacade', 'Vendor\Package\Facades\Wrapper');
//...
```

In the `handleConfigs()` method, you'll want to change the "packagename" references to the name you chose up above (in the [config/packagename.php] instructions).


### src/Facades/Wrapper.php

In the `getFacadeAccessor()` method, change the "packagename" to the one you previously used for the app array index on the `register()` method:

```php
//...
protected static function getFacadeAccessor() { return 'packagename'; }
//...
```


### src/Wrapper.php

In this file, update `__constructor()` method to initialize the client instance and everything needed of your wrapped PHP library.


### Last Steps

Update the `LICENSE` file as required (make sure it matches what you said your package's license is in `composer.json`).

Finally, edit this `README.md` file and replace it with a description of your own, awesome Laravel 5 package.

Commit everything to your (newly initialized) git repo, and push it wherever you'll keep your package (Github, Packagist, etc.).

Happy coding!
