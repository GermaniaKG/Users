<?php
namespace Germania\Users;



interface UserInterface extends UserIdAwareInterface
{

    public function getFullName();

    /**
     * @return boolean
     */
    public function isActive();

    /**
     * @return DateTime
     */
    public function getCreationDateTime();

    /**
     * @return DateTime
     */
    public function getLastUpdateDateTime();


    public function setDisplayName( $name );
    public function getDisplayName();

    public function setFirstName($name);
    public function getFirstName();

    public function setLastName($name);
    public function getLastName();

    public function setLoginName($name);
    public function getLoginName();

    public function setEmail( $email);
    public function getEmail();

    public function getApiKey();
    public function setApiKey( $key );


}
