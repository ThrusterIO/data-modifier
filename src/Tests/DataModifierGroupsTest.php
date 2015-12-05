<?php

namespace Thruster\Component\DataModifier\Tests;

use Thruster\Component\DataModifier\DataModifierGroups;

class DataModifierGroupsTest extends \PHPUnit_Framework_TestCase
{

    public function testAddGroup()
    {
        $group = $this->getMock('\Thruster\Component\DataModifier\DataModifierGroup');

        $groups = new DataModifierGroups();

        $this->assertFalse($groups->hasGroup('foo_bar'));

        $groups->addGroup('foo_bar', $group);

        $this->assertTrue($groups->hasGroup('foo_bar'));

        $this->assertEquals($group, $groups->getGroup('foo_bar'));

        $groups->removeGroup('foo_bar');

        $this->assertFalse($groups->hasGroup('foo_bar'));
    }

    /**
     * @expectedException \Thruster\Component\DataModifier\Exception\DataModifierGroupNotFoundException
     * @expectedExceptionMessage DataModifier group "foo_bar" not found
     */
    public function testGroupNotExistException()
    {
        $groups = new DataModifierGroups();
        $groups->getGroup('foo_bar');
    }

    public function testSetAndGetGroups()
    {
        $group = $this->getMock('\Thruster\Component\DataModifier\DataModifierGroup');

        $groups = new DataModifierGroups();

        $this->assertFalse($groups->hasGroup('foo_bar'));

        $groups->setGroups(['foo_bar' => $group]);

        $this->assertTrue($groups->hasGroup('foo_bar'));

        $this->assertEquals(['foo_bar' => $group], $groups->getGroups());
    }
}
