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

Add Module In Mail-local.php
----------------------------
```php
'emailtemplate' => [
    'class' => 'vendor\groovy\src\email\components\EmailsTemplate',
],
```

Add components In Mail-local.php
----------------------------
```php
'email' => [
            'class' => 'vendor\groovy\src\email\Module',
        ],
```


Usage
-----

```php
$string_array = array(
    '{{Password}}'=>$password,
);

```
