<?php
namespace tests;

use Germania\Users\PdoUserLoginNameFactory;
use Germania\Users\PdoAllActiveUsers;
use Germania\Users\UserAbstract;
use Germania\Users\UsersInterface;
use Germania\Users\UserNotFoundException;
use Prophecy\Argument;
use Interop\Container\ContainerInterface;


class PdoUserLoginNameFactoryTest extends \PHPUnit\Framework\TestCase
{

    public $login_name = "carstenwitt@germania-kg.de";

    public function testSimpleUsage( )
    {

        $execution_result = true;
        $users_result     = array();

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $sut = new PdoUserLoginNameFactory( $pdo->reveal(), $user->reveal() );
        $this->assertInstanceOf( \PDOStatement::class, $sut->stmt);
    }



    public function testContainerInterface( )
    {

        $execution_result = true;
        $users_result     = array("foo");

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $sut = new PdoUserLoginNameFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->has( $this->login_name ));

        $this->assertEquals($users_result, $sut->get( $this->login_name ));
    }


    public function testFailureOnStatementExecution( )
    {

        $execution_result = false;
        $users_result     = array("foo");

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $this->expectException( \RuntimeException::class);

        $sut = new PdoUserLoginNameFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->has( $this->login_name ));
    }



    public function testRuntimeExceptionOnGettingUser( )
    {

        $execution_result = false;
        $users_result     = false;

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $this->expectException( \RuntimeException::class);

        $sut = new PdoUserLoginNameFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->get( $this->login_name ));
    }



    public function testUserNotFoundException( )
    {

        $execution_result = true;
        $users_result     = false;

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( Argument::type('array') )->willReturn( $execution_result );
        $stmt->fetch( )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

            $this->expectException( UserNotFoundException::class);

        $sut = new PdoUserLoginNameFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->get( $this->login_name ));
    }



}

