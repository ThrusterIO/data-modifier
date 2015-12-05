<?php

namespace Thruster\Component\DataModifier;

use Thruster\Component\DataModifier\Exception\DataModifierGroupNotFoundException;

/**
 * Class DataModifierGroups
 *
 * @package Thruster\Component\DataModifier
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class DataModifierGroups
{
    /**
     * @var DataModifierGroup[]
     */
    protected $dataModifierGroups;

    public function __construct()
    {
        $this->dataModifierGroups = [];
    }

    /**
     * @param string            $groupName
     * @param DataModifierGroup $group
     *
     * @return $this
     */
    public function addGroup(string $groupName, DataModifierGroup $group) : self
    {
        $this->dataModifierGroups[$groupName] = $group;

        return $this;
    }

    /**
     * @param string $groupName
     *
     * @return bool
     */
    public function hasGroup(string $groupName) : bool
    {
        return array_key_exists($groupName, $this->dataModifierGroups);
    }

    /**
     * @param string $groupName
     *
     * @return DataModifierGroup
     * @throws DataModifierGroupNotFoundException
     */
    public function getGroup(string $groupName) : DataModifierGroup
    {
        if (false === $this->hasGroup($groupName)) {
            throw new DataModifierGroupNotFoundException($groupName);
        }

        return $this->dataModifierGroups[$groupName];
    }

    /**
     * @param string $groupName
     *
     * @return $this
     */
    public function removeGroup(string $groupName) : self
    {
        unset($this->dataModifierGroups[$groupName]);

        return $this;
    }

    /**
     * @return DataModifierGroup[]
     */
    public function getGroups() : array
    {
        return $this->dataModifierGroups;
    }

    /**
     * @param DataModifierGroup[] $dataModifierGroups
     *
     * @return $this
     */
    public function setGroups($dataModifierGroups) : self
    {
        $this->dataModifierGroups = $dataModifierGroups;

        return $this;
    }
}
