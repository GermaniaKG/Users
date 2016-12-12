<?php
namespace tests;

use Germania\Users\PdoAllActiveUsers;
use Germania\Users\User;
use Germania\Users\UserAbstract;
use Germania\Users\UsersInterface;
use Prophecy\Argument;
use Interop\Container\ContainerInterface;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleInstantiation( )
    {
        $sut = new User;

        $sut->setId("foo");
        $sut->setDisplayName("foo");
        $sut->setFirstName("foo");
        $sut->setLastName("foo");
        $sut->setLoginName("foo");
        $sut->setEmail("foo");
        $sut->setApiKey("foo");

        $this->assertEquals("foo", $sut->getId("foo"));
        $this->assertEquals("foo", $sut->getDisplayName("foo"));
        $this->assertEquals("foo", $sut->getFirstName("foo"));
        $this->assertEquals("foo", $sut->getLastName("foo"));
        $this->assertEquals("foo", $sut->getLoginName("foo"));
        $this->assertEquals("foo", $sut->getEmail("foo"));
        $this->assertEquals("foo", $sut->getApiKey("foo"));

        $this->assertInternalType("string", $sut->getFullName());


    }
}
