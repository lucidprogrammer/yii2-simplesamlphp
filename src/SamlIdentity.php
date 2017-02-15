<?php

/**
 * Identity Object as per yii2
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-security-authentication.html
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp;


use yii;
use yii\base\Object;
use yii\web\IdentityInterface;
use lucidprogrammer\simplesamlphp\SamlIdentity;

class SamlIdentity extends Object implements IdentityInterface {

  public $id;
  public $attributes;


  public function __construct($id,$attributes, $config = [])
  {
      $this->id = $id;
      $this->attributes = $attributes;
      parent::__construct($config);
  }


  /**
   * Finds an identity by the given ID.
   *
   * @param string|int $id the ID to be looked for
   * @return IdentityInterface|null the identity object that matches the given ID.
   */
    public static function findIdentity($id)

    {
      $attributes = Yii::$container->get('saml')->getAttributes();
      if(sizeof($attributes) > 0){
        $id = $attributes['username'][0];
        return new SamlIdentity($id,$attributes);
      }
      return null;


    }

  /**
   * @return int|string current user ID
   */
    public function getId()
    {
        return $this->id;
    }

  /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {

    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {

    }
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name][0] : null;
    }




}
