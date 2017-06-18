<?php
include_once "protected/Game.php";

$game = Game::getInstance();
if (isset($_POST['fieldCoordinate'])) {
    $game->makeMove($_POST['fieldCoordinate']);
    echo json_encode(['gameState' => $game->getState(), 'message' => $game->getMessage(), 'sign' => $game->getCurrentPlayer()]);
}

if (isset($_POST['sessionClear'])) {
    echo json_encode(['state' => session_destroy()]);
}
