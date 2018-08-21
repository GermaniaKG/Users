<?php
namespace tests;

use Germania\Users\PdoAllActiveUsers;
use Germania\Users\User;
use Germania\Users\UserAbstract;
use Germania\Users\UsersInterface;
use Prophecy\Argument;
use Interop\Container\ContainerInterface;

class UserTest extends \PHPUnit\Framework\TestCase
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


    /**
     * @dataProvider provideNameCombinations
     */
    public function testToStringMethod( $expected, $display_name, $login_name)
    {
        $sut = new User;
        $sut->setDisplayName( $display_name );
        $sut->setLoginName( $login_name );

        $this->assertEquals($expected, $sut->__toString());
    }


    /**
     * @dataProvider provideFalsyValues
     */
    public function testIsActiveFalse( $falsy_value )
    {
        $sut = new User;
        $sut->is_active = $falsy_value;
        $this->assertFalse( $sut->isActive());
    }


    public function testCreationTimestampGetters( )
    {
        $sut = new User;
        $this->assertEmpty( $sut->getCreationDateTime());

        $now = new \DateTime;
        $now_format = $now->format("Y-m-d H:i:s");

        $sut->created = $now_format;
        $ku = $sut->getCreationDateTime();
        $this->assertEquals( $now_format, $ku->format("Y-m-d H:i:s"));
    }



    public function testUpdateTimestampGetters( )
    {
        $sut = new User;
        $this->assertEmpty( $sut->getLastUpdateDateTime());

        $now = new \DateTime;
        $now_format = $now->format("Y-m-d H:i:s");

        $sut->updated = $now_format;
        $ku = $sut->getLastUpdateDateTime();
        $this->assertEquals( $now_format, $ku->format("Y-m-d H:i:s"));
    }



    /**
     * @dataProvider provideTrueyValues
     */
    public function testIsActiveTrue( $truey_value )
    {
        $sut = new User;
        $sut->is_active = $truey_value;
        $this->assertTrue( $sut->isActive());
    }


    public function provideFalsyValues()
    {
        return array(
            [ 0 ],
            [ null ],
            [ "" ],
            [ false ],
            [ array() ]
        );
    }

    public function provideTrueyValues()
    {
        return array(
            [ 1 ],
            [ "notempty" ],
            [ true ],
            [ array("foo") ]
        );
    }


    public function provideNameCombinations()
    {
        return array(
            [ "foo", "foo", "bar"],
            [ "foo", "foo",  null],
            [ "bar", null,  "bar"]
        );
    }
}
