Groovy Email Template
=====================
Groovy Email Template

Installation ---- V2
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
php yii migrate --migrationPath=vendor/groovy/src/migrations
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
    'allowDelete'=>true,
    'allowInsert'=>true,
    'dummycontent'=> dirname(dirname(__DIR__))."/frontend/web/emailtemplate/dummy.html",
    'icons'=>["update"=>"glyphicon glyphicon-pencil","view"=>"glyphicon glyphicon-eye-open","delete"=>"glyphicon glyphicon-trash"],
],
```


Usage
-----

```php
// Need Email HTML dynamic
$string_array = array(
    '{{Password}}'=>$password,
);
$html = Yii::$app->emailtemplate->replace_string_email($string_array ,"welcome_email"); // $string_array = Array Of String welcome_email = Email Slug

// Need Email HTML Subject
$subject_string_array = array(
     "{{app_name}}"=>Yii::$app->name
);
$subject = Yii::$app->emailtemplate->replace_string_email($subject_string_array ,"welcome_email","subject");// $string_array = Array Of String welcome_mail = Email Slug and subject

```
