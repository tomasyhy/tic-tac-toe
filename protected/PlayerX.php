<?php

include_once "PlayerAction.php";

/**
 * Created by PhpStorm.
 * User: tomaszh
 * Date: 08.06.2017
 * Time: 21:18
 */

class PlayerX implements PlayerAction
{
    const SIGN = 'X';

    /**
     * @return string
     */
    public function getSign(): string
    {
        return self::SIGN;
    }
}