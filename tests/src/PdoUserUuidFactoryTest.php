<?php
namespace tests;

use Germania\Users\PdoUserUuidFactory;
use Germania\Users\PdoAllActiveUsers;
use Germania\Users\UserAbstract;
use Germania\Users\UsersInterface;
use Germania\Users\UserNotFoundException;
use Prophecy\Argument;
use Interop\Container\ContainerInterface;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidFactoryInterface;

class PdoUserUuidFactoryTest extends \PHPUnit\Framework\TestCase
{


    public function testSimpleUsage( )
    {

        $execution_result = true;
        $users_result     = array();
        $uuid = "42b50403-f8cb-4375-929d-43a94e243d2d";

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $uuid_factory = $this->prophesize( UuidFactoryInterface::class );
        $uuid_factory->fromString( Argument::type('string') )->willReturn( $uuid );
        $sut = new PdoUserUuidFactory( $pdo->reveal(), $uuid_factory->reveal(), $user->reveal() );
        $this->assertInstanceOf( \PDOStatement::class, $sut->stmt);
    }



    public function testContainerInterface( )
    {

        $execution_result = true;
        $users_result     = array("foo");
        $uuid = "42b50403-f8cb-4375-929d-43a94e243d2d";

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );
        $uuid_factory = $this->prophesize( UuidFactoryInterface::class );
        $uuid_factory->fromString( Argument::type('string') )->willReturn( $uuid );
        $sut = new PdoUserUuidFactory( $pdo->reveal(), $uuid_factory->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->has( $uuid ));

        $this->assertEquals($users_result, $sut->get( $uuid ));
    }


    public function testFailureOnStatementExecution( )
    {

        $execution_result = false;
        $users_result     = array("foo");
        $uuid = "42b50403-f8cb-4375-929d-43a94e243d2d";

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $this->expectException( \RuntimeException::class);
        $uuid_factory = $this->prophesize( UuidFactoryInterface::class );
        $uuid_factory->fromString( Argument::type('string') )->willReturn( $uuid );
        $sut = new PdoUserUuidFactory( $pdo->reveal(), $uuid_factory->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->has( $uuid ));
    }



    public function testRuntimeExceptionOnGettingUser( )
    {

        $execution_result = false;
        $users_result     = false;
        $uuid = "42b50403-f8cb-4375-929d-43a94e243d2d";

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $this->expectException( \RuntimeException::class);
        $uuid_factory = $this->prophesize( UuidFactoryInterface::class );
        $uuid_factory->fromString( Argument::type('string') )->willReturn( $uuid );
        $sut = new PdoUserUuidFactory( $pdo->reveal(), $uuid_factory->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->get( $uuid ));
    }



    public function testUserNotFoundException( )
    {

        $execution_result = true;
        $users_result     = false;
        $uuid = "42b50403-f8cb-4375-929d-43a94e243d2d";

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $this->expectException( UserNotFoundException::class);

        $uuid_factory = $this->prophesize( UuidFactoryInterface::class );
        $uuid_factory->fromString( Argument::type('string') )->willReturn( $uuid );
        $sut = new PdoUserUuidFactory( $pdo->reveal(), $uuid_factory->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->get( $uuid ));
    }



}

