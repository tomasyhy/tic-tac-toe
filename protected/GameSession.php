<?php

include_once "PlayerO.php";
include_once "PlayerX.php";


/**
 * Created by PhpStorm.
 * User: tomaszh
 * Date: 07.06.2017
 * Time: 13:27
 */

class GameSession
{
    /**
     * GameSession constructor.
     */
    function __construct()
    {
        session_start();
    }

    /**
     *
     */
    public function setCurrentPlayer()
    {
        if ($this->getCurrentPlayer()) {
            $_SESSION['currentPlayer'] = $this->getNextPlayer()->getSign();
        } else {
            $_SESSION['currentPlayer'] = $this->getStartPlayer()->getSign();
        }
    }

    /**
     * @return PlayerO
     */
    private function getStartPlayer(): PlayerO
    {
        return new PlayerO();
    }

    /**
     * @return PlayerO
     */
    private function getNextPlayer(): PlayerAction
    {
        if ($this->getCurrentPlayer() === PlayerO::SIGN) {
            return new PlayerX();
        } else {
            return new PlayerO();
        }
    }

    /**
     * @return null
     */
    public function getCurrentPlayer()
    {
        return $_SESSION['currentPlayer'] ?? null;
    }

    /**
     * @return array
     */
    public function getCurrentPlayerFields(): array
    {
        return $_SESSION[$this->getCurrentPlayer()]['fields'];
    }

    /**
     * @param string $player
     * @return array
     */
    public function getPlayerFields(string $player): array
    {
        return $_SESSION[$player]['fields'];
    }

    /**
     * @param $fieldCoordinates
     */
    public function saveMove($fieldCoordinates)
    {
        $_SESSION[$this->getCurrentPlayer()]['fields'][] = $fieldCoordinates;
    }

}