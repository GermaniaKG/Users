<?php
namespace Germania\Users;



class User extends UserAbstract implements UserInterface
{

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
