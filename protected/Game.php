<?php
include_once "GameSession.php";
/**
 * Created by PhpStorm.
 * User: tomaszh
 * Date: 07.06.2017
 * Time: 13:08
 */

class Game
{
    const STATE_PENDING = 'Pending';
    const STATE_DRAW = 'Draw';
    const STATE_END = 'End';

    const MIN_NUMBER_FIELD_TO_WIN = 3;
    const ALL_FIELDS_COUNT = 9;

    private static $instance;
    private $_gameSession;
    private $_state = self::STATE_PENDING;
    private $_message;
    private $_winningCoordinates = [
        //row
        [11, 12, 13],
        [21, 22, 23],
        [31, 32, 33],
        //columns
        [11, 21, 31],
        [12, 22, 32],
        [13, 23, 33],
        //cross
        [11, 22, 33],
        [31, 22, 13],
    ];

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->_gameSession = new GameSession();
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }

    /**
     * @return int
     */
    public function getState(): string
    {
        return $this->_state;
    }

    /**
     * @param int $state
     */
    public function setState(string $state)
    {
        $this->_state = $state;
    }

    /**
     * @return Game
     */
    public static function getInstance(): Game
    {
        if (self::$instance === null) {
            self::$instance = new Game();
        }
        return self::$instance;
    }

    /**
     * @param string $field
     */
    public function makeMove(string $field)
    {
        $this->_gameSession->setCurrentPlayer();
        $this->_gameSession->saveMove((int)$field);
        $this->setGameState();
    }

    public function getCurrentPlayer()
    {
        return $this->_gameSession->getCurrentPlayer();
    }

    private function setGameState()
    {
        $currentPlayerFields = $this->_gameSession->getCurrentPlayerFields();
        if (count($currentPlayerFields) >= self::MIN_NUMBER_FIELD_TO_WIN) {
            $this->checkGameState();
        }
    }

    /**
     *
     */
    private function checkGameState() {
        if ($isWinner = $this->playerIsWinner()) {
            $this->setState(self::STATE_END);
            $this->setMessage('Player ' . $this->_gameSession->getCurrentPlayer() . ' is winner');
        } elseif (!$isWinner && $this->allFieldsAreOccupied()) {
            $this->setState(self::STATE_DRAW);
        }
    }

    /**
     * @return bool
     */
    private function playerIsWinner(): bool
    {
        foreach ($this->_winningCoordinates as $winningCoordinate) {
            if($this->playerHasWinningLine($winningCoordinate)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $winningCoordinate
     * @return bool
     */
    private function playerHasWinningLine(array $winningCoordinate): bool {

        foreach ($winningCoordinate as $coordinate) {
            if(!in_array($coordinate, $this->_gameSession->getCurrentPlayerFields())) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    private function allFieldsAreOccupied(): bool
    {
        $playerOFieldsCount = count($this->_gameSession->getPlayerFields(PlayerO::SIGN));
        $playerXFieldsCount = count($this->_gameSession->getPlayerFields(PlayerX::SIGN));
        if($playerOFieldsCount + $playerXFieldsCount === self::ALL_FIELDS_COUNT ) {
            return true;
        } else {
            return false;
        }
    }

}