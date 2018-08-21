<?php
namespace Germania\Users;



class User extends UserAbstract implements UserInterface
{

    /**
     * @return string The user display or login name
     */
    public function __toString()
    {
        return $this->getDisplayName() ?: $this->getLoginName();
    }


    /**
     * Returns a concatenation of the users' first and last name.
     *
     * @return string
     * @uses   getFirstName()
     * @uses   getLastName()
     */
    public function getFullName() {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }



}
