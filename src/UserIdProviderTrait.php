<?php
namespace Germania\Users;

trait UserIdProviderTrait
{

    /**
     * Database ID (primary key) of the user.
     */
    public $id;



    /**
     * Returns the database ID (primary key) of the user.
     *
     * @uses $id
     */
    public function getId()
    {
        return $this->id;
    }
}
