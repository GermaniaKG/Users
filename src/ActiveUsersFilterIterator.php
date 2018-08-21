<?php
namespace Germania\Users;

class ActiveUsersFilterIterator extends \FilterIterator
{
    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        return (($current instanceOf UserInterface)
        and $current->isActive());
    }
}
