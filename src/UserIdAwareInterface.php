<?php
namespace Germania\Users;

interface UserIdAwareInterface extends UserIdProviderInterface
{
    public function setId($id);
}
