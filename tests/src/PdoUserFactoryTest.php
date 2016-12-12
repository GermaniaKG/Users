<?php
namespace tests;

use Germania\Users\PdoUserFactory;
use Germania\Users\PdoAllActiveUsers;
use Germania\Users\UserAbstract;
use Germania\Users\UsersInterface;
use Germania\Users\UserNotFoundException;
use Prophecy\Argument;
use Interop\Container\ContainerInterface;


class PdoUserFactoryTest extends \PHPUnit_Framework_TestCase
{


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

        $sut = new PdoUserFactory( $pdo->reveal(), $user->reveal() );
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

        $sut = new PdoUserFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->has( 42 ));

        $this->assertEquals($users_result, $sut->get( 42 ));
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

        $sut = new PdoUserFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->has( 42 ));
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

        $sut = new PdoUserFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->get( 42 ));
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

        $sut = new PdoUserFactory( $pdo->reveal(), $user->reveal() );

        $this->assertInternalType("bool", $sut->get( 42 ));
    }



}

