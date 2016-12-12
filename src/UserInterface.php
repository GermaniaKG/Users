<?php
namespace Germania\Users;



interface UserInterface
{


    public function setId($id);
    public function getId();

    public function getFullName();

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
