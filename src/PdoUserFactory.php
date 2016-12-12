<?php
namespace Germania\Users;

use Interop\Container\ContainerInterface;

class PdoUserFactory implements ContainerInterface
{

    /**
     * @var string
     */
    public $table = 'users';


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
        $this->pdo      = $pdo;
        $this->table    = $table ?: $this->table;

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

        WHERE U.id = :id
        AND   U.is_active > 0";

        $this->stmt = $pdo->prepare( $sql );

        $this->stmt->setFetchMode( \PDO::FETCH_CLASS, $user ? get_class($user) : User::class );

    }


    public function has ($id) {
        if (!$this->stmt->execute([
            'id' => $id
        ])):
            throw new \RuntimeException("Could not read User from database");
        endif;

        return (bool) $this->stmt->fetch();
    }


    public function get ($id) {
        if (!$this->stmt->execute([
            'id' => $id
        ])):
            throw new \RuntimeException("Could not read User from database");
        endif;


        if ($user = $this->stmt->fetch()) {
            return $user;
        }

        throw new UserNotFoundException("Could not find User with ID '$id'");
    }

}

