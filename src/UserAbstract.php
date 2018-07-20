<?php
namespace Germania\Users;


abstract class UserAbstract  implements UserInterface
{

    use UserIdAwareTrait;

    public $display_name;
    public $first_name;
    public $last_name;
    public $login_name;
    public $email;
    public $api_key;


/**
 * Returns the user's full name
 */
    abstract public function getFullName();




/**
 * @uses $display_name
 */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
        return $this;
    }



/**
 * @return string
 * @uses   $display_name
 */
    public function getDisplayName()
    {
        return $this->display_name;
    }









/**
 * @param  string $name
 * @return self
 * @uses   $first_name
 */
    public function setFirstName($name)
    {
        $this->first_name = $name;
        return $this;
    }


/**
 * @uses $first_name
 */
    public function getFirstName()
    {
        return $this->first_name;
    }




/**
 * @param  string $name
 * @return self
 * @uses   $last_name
 */
    public function setLastName($name)
    {
        $this->last_name = $name;
        return $this;
    }


/**
 * @uses $last_name
 */
    public function getLastName()
    {
        return $this->last_name;
    }




/**
 * @param  string $name
 * @return self
 * @uses   $login_name
 */
    public function setLoginName($name)
    {
        $this->login_name = $name;
        return $this;
    }


/**
 * @uses $login_name
 */
    public function getLoginName()
    {
        return $this->login_name;
    }





/**
 * @param  mixed $email
 * @return self
 */
    public function setEmail( $email)
    {
        $this->email = $email;
        return $this;
    }


/**
 * @uses $email
 */
    public function getEmail()
    {
        return $this->email;
    }





/**
 * Returns the users API key (if defined)
 *
 * @return string|null
 * @uses   $api_key
 */
    public function getApiKey()
    {
        return $this->api_key;
    }


/**
 * Sets the users API key
 *
 * @return self
 * @uses   $api_key
 */
    public function setApiKey( $key )
    {
        $this->api_key = $key;
        return $this;
    }



}
