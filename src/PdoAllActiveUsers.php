<?php
namespace Germania\Users;

class PdoAllActiveUsers extends PdoAllUsers implements UsersInterface
{

    /**
     * @var string
     */
    public $table = 'users';


    /**
     * @var array
     */
    public $users = array();


    /**
     * @param PDO           $pdo
     * @param UserAbstract  $user   Optional: User template object
     * @param string        $table  Optional: Users table name
     */
    public function __construct( \PDO $pdo, UserAbstract $user = null, $table = null  )
    {
        parent::__construct( $pdo, $user, $table );

        $active = new ActiveUsersFilterIterator( $this );
        $this->users = iterator_to_array( $active );
    }

}

