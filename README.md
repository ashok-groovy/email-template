Groovy Email Template
=====================
Groovy Email Template

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist groovy/src "*"
```

or add

```
"groovy/src": "dev-master"
```

to the require section of your `composer.json` file.

Migrate Fisrt 
-----
```php 
php yii migrate --migrationPath=vendor/groovy/src/migrations create_email_template_table
```

Usage
-----

Pending Added