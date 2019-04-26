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

Migrate First 
-----
```php 
php yii migrate --migrationPath=vendor/groovy/src/migrations create_email_template_table
```

Add Module
----------------------------
```php
'email' => [
    'class' => 'vendor\groovy\src\email\Module',
],

```

Add components
----------------------------
```php
'emailtemplate' => [
    'class' => 'vendor\groovy\src\email\components\EmailsTemplate',
],
```


Usage
-----

```php
$string_array = array(
    '{{Password}}'=>$password,
);
$html = Yii::$app->emailtemplate->replace_string_email($string_array ,"welcome_mail "); // $string_array = Array Of String welcome_mail = Email Slug
```
