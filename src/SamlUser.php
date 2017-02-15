<?php
/**
 * User Object as per yii2, minor changes to the yii\web\User
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-security-authentication.html
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp;

use yii;
use yii\web\User;

class SamlUser extends User
{
  /**
  * changing the loginUrl and identityClass
  * so while configuring yii2, just point to the user class and all other auth rules should automatically work.
  */
  public function init()
  {
      $this->loginUrl = ['_saml/login'];
      $this->identityClass = 'lucidprogrammer\simplesamlphp\SamlIdentity';
      $this->enableAutoLogin = true;
      parent::init();
  }

  public function logout($destroySession = true)
  {

    Yii::$container->get('saml')->logout(Yii::$app->homeUrl);
    parent::logout($destroySession);

  }


}
