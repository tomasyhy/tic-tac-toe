<?php

include_once "PlayerAction.php";

/**
 * Created by PhpStorm.
 * User: tomaszh
 * Date: 17.06.2017
 * Time: 12:58
 */

class PlayerO implements PlayerAction
{
    const SIGN = 'O';

    public function getSign()
    {
        return self::SIGN;
    }
}