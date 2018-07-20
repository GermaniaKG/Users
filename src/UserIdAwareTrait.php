<?php
namespace Germania\Users;

trait UserIdAwareTrait
{

    use UserIdProviderTrait;


    /**
     * Sets the database ID (primary key) of the user.
     *
     * @param  int|string $id
     * @return self
     * @uses   $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

}
