<?php
namespace Germania\Users;

class PdoAllActiveUsers extends Users implements UsersInterface
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
        $this->table = $table ?: $this->table;

        // ID is listed twice here in order to use it with FETCH_UNIQUE as array key
        $sql = "SELECT
        id,
        id                 AS id,
        user_first_name    AS first_name,
        user_last_name     AS last_name,
        user_login_name    AS description,
        user_display_name  AS login_name,
        user_email         AS email,
        api_key            AS api_key

        FROM {$this->table}
        WHERE is_active > 0";

        $stmt = $pdo->prepare( $sql );

        $stmt->setFetchMode( \PDO::FETCH_CLASS, $user ? get_class($user) : User::class );

        if (!$stmt->execute()):
            throw new \RuntimeException("Could not retrieve Users from database");
        endif;

        $this->users = $stmt->fetchAll(\PDO::FETCH_UNIQUE);
    }

}

