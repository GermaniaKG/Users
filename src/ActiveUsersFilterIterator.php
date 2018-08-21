<?php
namespace Germania\Users;

class ActiveUsersFilterIterator extends \FilterIterator
{

    public function __construct( \Traversable $users )
    {
        parent::__construct( new \IteratorIterator( $users ));
    }
    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        return (($current instanceOf UserInterface)
        and $current->isActive());
    }
}
