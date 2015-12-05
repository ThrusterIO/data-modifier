<?php

namespace Thruster\Component\DataModifier;

/**
 * Class DataModifierGroup
 *
 * @package Thruster\Component\DataModifier
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class DataModifierGroup
{
    /**
     * @var DataModifierInterface[]
     */
    protected $dataModifiers;
    /**
     * @var DataModifierInterface[]
     */
    protected $sortedDataModifiers;

    public function __construct()
    {
        $this->dataModifiers       = [];
        $this->sortedDataModifiers = [];
    }

    /**
     * @param DataModifierInterface $dataModifier
     * @param int                   $priority
     *
     * @return $this
     */
    public function addModifier(DataModifierInterface $dataModifier, int $priority = 0) : self
    {
        $this->dataModifiers[$priority][] = $dataModifier;
        $this->sortedDataModifiers = null;

        return $this;
    }

    /**
     * @return DataModifierInterface[]
     */
    public function getModifiers() : array
    {
        if (null !== $this->sortedDataModifiers) {
            return $this->sortedDataModifiers;
        }

        krsort($this->dataModifiers);
        $this->sortedDataModifiers = call_user_func_array('array_merge', $this->dataModifiers);

        return $this->sortedDataModifiers;
    }

    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function modify($input)
    {
        foreach ($this->getModifiers() as $modifier) {
            $input = $modifier->modify($input);
        }

        return $input;
    }
}
