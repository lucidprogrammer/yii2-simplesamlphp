<?php

/**
 * Adding a controller which is going to give a login route which is _saml/login
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-structure-controllers.html
 *
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp;
use yii;
use yii\web\Controller;
use lucidprogrammer\simplesamlphp\SamlIdentity;

class _SamlController extends Controller {
  public function actionLogin(){
    if (!Yii::$container->get('saml')->isAuthenticated()) {
      Yii::$container->get('saml')->requireAuth();
    } else {
      $attributes = Yii::$container->get('saml')->getAttributes();
      $id = $attributes['username'][0];
      Yii::$app->user->login(new SamlIdentity($id,$attributes), 0);
      $this->goBack();
    }

  }

}
