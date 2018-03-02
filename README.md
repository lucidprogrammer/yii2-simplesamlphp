# yii2-simplesamlphp

SAML Service Provider(SP) for Yii2 using simplesamlphp (yii2 extension). This is useful when you want to act as a Service Provider(SP), where a partner company is acting as a SAML Identity Provider (IDP). User data and their credentials are with the IDP and you are using SAML based login and use those users information in your yii2 application.

This is a very basic implementation where we are not persisting user data coming from the IDP at the Service Provider side for reporting on usage etc. However, those are fairly straightforward additions one can do.

# Installation

This is available to be installed via composer. In your yii2 application folder, run the following command.

```
composer require lucidprogrammer/yii2-simplesamlphp
```

This will install the package as a yii2 extension and update the extensions and installs the simplesamlphp project too in the vendor folder.

## Configuration

### Step 1 - Configuring an alias for /saml in your web server.

In a standard web server configuration like Apache, the DocumentRoot will be pointing to the yii2 application's web folder. Create an alias for /saml pointing to pathto_my-yii2-app/vendor/simplesamlphp/simplesamlphp/www.

In the case of Apache, you may do something like (replace pathto_my-yii2-app with your real path.)

```
echo "Alias /saml pathto_my-yii2-app/vendor/simplesamlphp/simplesamlphp/www" >> /etc/apache2/apache2.conf
echo "<Directory \"pathto_my-yii2-app/simplesamlphp/simplesamlphp/www/\"> \n Options Indexes FollowSymLinks \n AllowOverride all \n Require all granted \n   </Directory>" >> /etc/apache2/apache2.conf
```

To explain it visually, following could help.
```
my-yii2-app/
          /web    -> DocumentRoot
          ..
          ..
          /vendor
              ...
              ...
              /lucidprogrammer  (newly created folder in vendor)
              /simplesamlphp    (newly created folder in vendor)
                  /simplesamlphp/wwww      -> [Create an alias /saml pointing to pathto_my-yii2-app/vendor/simplesamlphp/simplesamlphp/www]
```

### Step 2 - Configure yii2 configuration.

Yii configuration straightforward, just add the following in your config/web.php

```
'user' => [
    'class' => 'lucidprogrammer\simplesamlphp\SamlUser',
    //idAttribute is mandatory
    //for example, if your IDP is sending a SAML payload which has ID, you may do as follows
    'idAttribute' => 'ID',
    //if you want to map IDP provided attributes to something else, you may do additional mappings as name value pairs.
    //following are some examples, not mandatory
    'firstName' => 'givenName',
    'company' => 'companyName',
],

```
ADFS example,
```
'user' => [
    'class' => 'lucidprogrammer\simplesamlphp\SamlUser',
    //for example, if your IDP is ADFS, and you want to use email address as the unique ID
    'idAttribute' => 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress',
],

```


### Note on enabling authentication for a route using yii2

Let's say you have a rule like the following in your yii2 setting,

```
'access' => [
    'class' => AccessControl::className(),
    'only' => ['index','logout','about'],
    'rules' => [
      [
            'allow' => true,
            'actions' => ['index'],
            'roles' => ['?'],
        ],
        [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
        ],
    ],
  ],

```
After the component is installed, the moment you hit the site/about page, it should redirect you to the configured saml idp login page.

So, if you want to do SAML provided attributes and want to implement a fine grained access control, yii2 makes it easy.

### Note on yii2 login link.
If your application has links to login, for example, 'site/login', you need to change to _saml/login._

However, it is best if you use Yii::$app->user->loginUrl[0], so it will take whatever is the correct loginUrl, so it will work with or without this plugin.

## Sample app

https://github.com/lucidprogrammer/yii2-adfs-saml20-sp

# Changelog

02 March 2018
http://www.yiiframework.com/doc-2.0/yii-base-object.html
The class name `Object` is invalid since PHP 7.2, use [[BaseObject]] instead.
[handle backward compatibility to yii base Object]
Added SamlSettings options for easy configuration.
Tested with ADFS 3.0, Windows 2012 R2 & simplesamlphp (IDP)
