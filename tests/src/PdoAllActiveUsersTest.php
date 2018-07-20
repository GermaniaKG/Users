<?php
namespace tests;

use Germania\Users\PdoAllActiveUsers;
use Germania\Users\UserAbstract;
use Germania\Users\UsersInterface;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;

class PdoAllActiveUsersTest extends \PHPUnit\Framework\TestCase
{


    public function testSimpleUsage( )
    {

        $execution_result = true;
        $users_result     = array();

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( )->willReturn( $execution_result );
        $stmt->fetchAll( Argument::type('int') )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $sut = new PdoAllActiveUsers( $pdo->reveal(), $user->reveal() );

        $this->assertInstanceOf( \IteratorAggregate::class, $sut );
        $this->assertInstanceOf( \Countable::class, $sut );
        $this->assertInstanceOf( ContainerInterface::class, $sut );
        $this->assertInstanceOf( UsersInterface::class, $sut );


    }

    public function testFailureInStatementExecution( )
    {

        $execution_result = false;
        $users_result     = array();

        $stmt = $this->prophesize(\PDOStatement::class);
        $stmt->setFetchMode( Argument::type('integer'), Argument::type('string') )->willReturn( true );
        $stmt->execute( )->willReturn( $execution_result );
        $stmt->fetchAll( Argument::type('int') )->willReturn( $users_result );
        $stmt_mock = $stmt->reveal();

        $pdo = $this->prophesize(\PDO::class);
        $pdo->prepare( Argument::type('string') )->willReturn( $stmt_mock );

        $user = $this->prophesize( UserAbstract::class );

        $this->expectException(\RuntimeException::class);
        $sut = new PdoAllActiveUsers( $pdo->reveal(), $user->reveal() );





    }



}
