<?php

namespace Thruster\Component\DataModifier\Exception;

use Exception;

/**
 * Class DataModifierGroupNotFoundException
 *
 * @package Thruster\Component\DataModifier\Exception
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class DataModifierGroupNotFoundException extends \Exception
{
    /**
     * @inheritDoc
     */
    public function __construct($name)
    {
        $message = sprintf(
            'DataModifier group "%s" not found',
            $name
        );

        parent::__construct($message);
    }

}
