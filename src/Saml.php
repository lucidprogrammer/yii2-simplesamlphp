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
use yii\base\Object;

class Saml extends Object {

    /**
     * Authentication source you will use.
     */
    public $authSource='default-sp';

    /**
     * SimpleSAML_Auth_Simple's object.
     */
    private $auth;


    public function init() {
        $this->auth = new \SimpleSAML_Auth_Simple($this->authSource);
        parent::init();
    }


    /**
     * Make sure user is authenticated. If the user is not authenticated, he will be rediected to Simplesamlphp IdP login page. If he is authenticated, it does nothing.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_3
     */
    public function requireAuth(array $params = array()) {
        $this->auth->requireAuth($params);
    }

    /**
     * Log in the current user. He will be redirected to Simplesamlphp IdP login page. After a successfull login, he will be redirected to the referer page.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_4
     */
    public function login(array $params = array()) {
        $this->auth->login($params);
    }

    /**
     * Logout the current user. Clear Simplesamlphp Sp and Simplesamlphp IdP session and redirected to the referer page.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_5
     */
    public function logout($params = NULL) {
        $this->auth->logout($params);
    }

    /**
     * Get login url.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_8
     */
    public function getLoginURL($returnTo = null) {
        $this->auth->getLogoutUrl($returnTo);
    }

    /**
     * Get logout url.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_9
     */
    public function getLogoutURL($returnTo = null) {
        $this->auth->getLogoutUrl($returnTo);
    }

    /**
     * Check wether the user is authenticated or not.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_9
     * @return bool true if user is authenticated, false it he is not.
     */
    public function isAuthenticated() {
        return $this->auth->isAuthenticated();
    }

    /**
     * Get attributes which are returned from Simplesamlphp IdP after a successfull login.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_6
     * @return array attributes
     */
    public function getAttributes() {
        return $this->auth->getAttributes();
    }

    /**
     * Get auth data.
     * @see https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api#section_7
     * @return mixed
     */
    public function getAuthData(string $name) {
        return $this->auth->getAuthData($name);
    }

    /**
     * Get attribute by it's key.
     * @return string the attribute value
     */
    public function __get($name) {
        return isset($this->getAttributes()[$name]) ? $this->getAttributes()[$name][0] : null;
    }

}
