<?php

namespace Thruster\Component\DataModifier;

/**
 * Interface DataModifierInterface
 *
 * @package Thruster\Component\DataModifier
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
interface DataModifierInterface
{
    /**
     * Modify input
     *
     * @param mixed $input
     *
     * @return mixed
     */
    public function modify($input);
}
