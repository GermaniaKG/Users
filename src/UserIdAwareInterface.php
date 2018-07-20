<?php
namespace Germania\Users;

interface UserIdAwareInterface extends UserIdProviderInterface
{

    /**
     * Sets the database ID (primary key) of the user.
     *
     * @param  int|string $id
     */
    public function setId($id);
}
