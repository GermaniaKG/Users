<?php
namespace tests;

use Germania\Users\Users;
use Germania\Users\UsersInterface;
use Germania\Users\UserNotFoundException;
use Interop\Container\ContainerInterface;
use Prophecy\Argument;

class UsersTest extends \PHPUnit_Framework_TestCase
{


    public function testSimpleUsage( )
    {


        $sut = new Users;

        $this->assertInternalType( "array", $sut->users );
        $this->assertInternalType( "int", count($sut) );
        $this->assertInstanceOf( \IteratorAggregate::class, $sut );
        $this->assertInstanceOf( \Traversable::class, $sut->getIterator() );
        $this->assertInstanceOf( \Countable::class, $sut );
        $this->assertInstanceOf( ContainerInterface::class, $sut );
        $this->assertInstanceOf( UsersInterface::class, $sut );
    }


    public function testContainerInterfaceHasMethod( )
    {
        $sut = new Users;

        $this->assertInternalType( "bool", $sut->has( 22 ) );
    }


    public function testContainerInterfaceGetMethod( )
    {
        $id    = 42;
        $value = true;

        $sut = new Users;

        $sut->users[ $id ] = $value;
        $this->assertEquals( $sut->get( $id ), $value );
    }


    public function testUserNotFoundException( )
    {
        $id    = "notexistant";

        $sut = new Users;

        $this->expectException(UserNotFoundException::class);
        $sut->get( $id);
    }



}
