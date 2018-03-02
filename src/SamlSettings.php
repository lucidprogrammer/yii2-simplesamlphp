<?php
/**
 * Saml Object which uses the simplesamlphp project
 *
 * @see https://simplesamlphp.org
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp;
use yii\base\BaseObject;

class SamlSettings extends BaseObject {
var $idAttribute;
var $mappings;

  public function __construct ( $idAttribute, $mappings=[], $config = [] ){
          $this->idAttribute = $idAttribute;
          $this->mappings = $mappings;
          parent::__construct ( $config = [] );
    }



}
