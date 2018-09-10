<?php
namespace Germania\Users;

use Psr\Container\ContainerInterface;

class PdoUserLoginNameFactory implements ContainerInterface
{

    /**
     * @var string
     */
    public $table = 'users';

    /**
     * @var string
     */
    public $users_class;


    /**
     * @var PDOStatement
     */
    public $stmt;


    /**
     * @var PDO
     */
    public $pdo;


    /**
     * @param PDO           $pdo
     * @param UserAbstract  $user   Optional: User template object
     * @param string        $table  Optional: Users table name
     */
    public function __construct( \PDO $pdo, UserAbstract $user = null, $table = null )
    {
        $this->pdo             = $pdo;
        $this->table           = $table ?: $this->table;
        $this->php_users_class = $user ? get_class($user) : User::class;



        // ID is listed twice here in order to use it with FETCH_UNIQUE as array key
        $sql = "SELECT DISTINCT
        U.id                 AS id,
        U.user_first_name    AS first_name,
        U.user_last_name     AS last_name,
        U.user_login_name    AS login_name,
        U.user_display_name  AS display_name,
        U.user_email         AS email,
        U.api_key            AS api_key

        FROM {$this->table} U

        WHERE U.user_login_name = :user_login_name
        AND   U.is_active > 0";

        $this->stmt = $pdo->prepare( $sql );

        $this->stmt->setFetchMode( \PDO::FETCH_CLASS, $this->php_users_class );

    }


    public function __debugInfo() {
        return [
            'DatabaseTable' => $this->table,
            'UsersPhpClass' => $this->php_users_class
        ];
    }



    public function has ($user_login_name) {
        if (!$this->stmt->execute([
            'user_login_name' => $user_login_name
        ])):
            throw new \RuntimeException("Could not read User from database");
        endif;

        return (bool) $this->stmt->fetch();
    }


    public function get ($user_login_name) {
        if (!$this->stmt->execute([
            'user_login_name' => $user_login_name
        ])):
            throw new \RuntimeException("Could not read User from database");
        endif;


        if ($user = $this->stmt->fetch()) {
            return $user;
        }

        throw new UserNotFoundException("Could not find User with login name '$user_login_name'");
    }

}

