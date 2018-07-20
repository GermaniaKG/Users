<?php
namespace Germania\Users;

interface UserIdProviderInterface
{

    /**
     * Returns the database ID (primary key) of the user.
     *
     * @uses $id
     */
    public function getId();
}
