<?php
/**
 * Bootstrap class for the extension.
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-runtime-bootstrapping.html
 *
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp;
use yii;
use yii\base\BootstrapInterface;
use yii\base\Application;
use lucidprogrammer\simplesamlphp\Saml;
use lucidprogrammer\simplesamlphp\SamlSettings;

class BootstrapClass implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_REQUEST, function () {
            //creating a controller for the login route
            Yii::$app->controllerMap['_saml'] = '\lucidprogrammer\simplesamlphp\_SamlController';
            //a globally accessible instance of saml
            Yii::$container->set('saml',new Saml());
            Yii::$container->set('samlsettings',new SamlSettings());
            // TODO possibly check if the user has enabled /saml alias.
        });
    }


}
