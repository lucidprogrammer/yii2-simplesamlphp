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
use yii\base\BaseObject as Another;


if (class_exists('Another')) {
    class MiddleManClass extends Another { }
} else {
    class MiddleManClass extends \yii\base\Object{ }
}

class BaseObject extends MiddleManClass {

}
