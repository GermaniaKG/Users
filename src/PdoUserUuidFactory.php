<?php
namespace Germania\Users;

use Psr\Container\ContainerInterface;
use Ramsey\Uuid\UuidFactoryInterface;

class PdoUserUuidFactory implements ContainerInterface
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
     * @var Ramsey\Uuid\UuidFactory
     */
    public $uuid_factory;


    /**
     * @param \PDO                 $pdo           PDO instance
     * @param UuidFactoryInterface $uuid_factory  Ramsey's UUID factory
     * @param UserAbstract|null    $user          Optional: UserInterface instance
     * @param [type]               $table         Optional: table name
     */
    public function __construct( \PDO $pdo, UuidFactoryInterface $uuid_factory, UserAbstract $user = null, $table = null )
    {
        $this->pdo             = $pdo;
        $this->uuid_factory    = $uuid_factory;
        $this->table           = $table ?: $this->table;
        $this->php_users_class = $user ? get_class($user) : User::class;



        $sql = "SELECT DISTINCT
        U.id                 AS id,
        LOWER(HEX(U.uuid))   AS uuid,
        U.user_first_name    AS first_name,
        U.user_first_name    AS first_name,
        U.user_last_name     AS last_name,
        U.user_login_name    AS login_name,
        U.user_display_name  AS display_name,
        U.user_email         AS email,
        U.api_key            AS api_key

        FROM {$this->table} U

        WHERE U.uuid = UNHEX( REPLACE( :uuid, '-','') )
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



    public function has ($uuid) {
        $uuid = $this->assertUUID( $uuid );
        if (!$this->stmt->execute([
            'uuid' => $uuid
        ])):
            throw new \RuntimeException("Could not read User from database");
        endif;

        return (bool) $this->stmt->fetch();
    }


    public function get ($uuid) {
        $uuid = $this->assertUUID( $uuid );
        if (!$this->stmt->execute([
            'uuid' => $uuid
        ])):
            throw new \RuntimeException("Could not read User from database");
        endif;


        if ($user = $this->stmt->fetch()) {
            return $user;
        }

        throw new UserNotFoundException("Could not find User with UUID '$uuid'");
    }




    /**
     * @param  UuidInterface|string $uuid
     * @return UuidInterface
     *
     * @throws Ramsey\Uuid\Exception\InvalidUuidStringException
     */
    protected function assertUUID( $uuid )
    {
        if (is_string( $uuid )):
            $uuid = $this->uuid_factory->fromString( $uuid );
        elseif (!$uuid instanceOf UuidInterface):
            throw new \InvalidArgumentException("UuidInterface or UUID string expected");
        endif;

        return $uuid;

    }
}

