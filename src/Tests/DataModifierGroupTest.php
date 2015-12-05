<?php

namespace Thruster\Component\DataModifier\Tests;

use Thruster\Component\DataModifier\DataModifierGroup;

class DataModifierGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testAddModifier()
    {
        $aModifier = $this->getMockForAbstractClass('\Thruster\Component\DataModifier\DataModifierInterface');
        $bModifier = $this->getMockForAbstractClass('\Thruster\Component\DataModifier\DataModifierInterface');
        $cModifier = $this->getMockForAbstractClass('\Thruster\Component\DataModifier\DataModifierInterface');

        $group = new DataModifierGroup();
        $group->addModifier($aModifier, 3);
        $group->addModifier($bModifier, 1);
        $group->addModifier($cModifier, 2);

        $expected = [$bModifier, $cModifier, $aModifier];

        $this->assertEquals($expected, $group->getModifiers());
        $this->assertEquals($expected, $group->getModifiers());
    }

    public function testModify()
    {
        $input = new \stdClass();

        $aModifier = $this->getMockForAbstractClass('\Thruster\Component\DataModifier\DataModifierInterface');
        $bModifier = $this->getMockForAbstractClass('\Thruster\Component\DataModifier\DataModifierInterface');
        $cModifier = $this->getMockForAbstractClass('\Thruster\Component\DataModifier\DataModifierInterface');

        $aModifier->expects($this->once())
            ->method('modify')
            ->with($input)
            ->willReturn($input);

        $bModifier->expects($this->once())
            ->method('modify')
            ->with($input)
            ->willReturn($input);

        $cModifier->expects($this->once())
            ->method('modify')
            ->with($input)
            ->willReturn($input);

        $group = new DataModifierGroup();
        $group->addModifier($aModifier, 3);
        $group->addModifier($bModifier, 1);
        $group->addModifier($cModifier, 2);

        $this->assertEquals($input, $group->modify($input));
    }
}
