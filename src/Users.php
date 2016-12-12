<?php
namespace Germania\Users;

class Users implements UsersInterface
{

    /**
     * @var array
     */
    public $users = array();


    /**
     * @return UserInterface
     * @throws UserNotFoundException
     * @uses   $users
     */
    public function get( $id )
    {
        if ($this->has( $id )) {
            return $this->users[ $id ];
        }
        throw new UserNotFoundException("Could not find User with ID '$id'");
    }


    /**
     * @return boolean
     * @uses   $users
     */
    public function has ($id )
    {
        return array_key_exists( $id, $this->users);
    }



    /**
     * @return ArrayIterator
     * @uses   $users
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->users );
    }


    /**
     * @return int
     * @uses   $users
     */
    public function count()
    {
        return count($this->users);
    }
}
