<?php

 include ("Card.php");
 include ("Player.php");
 include ("Deck.php");
 include ("Game.php");

// Initialise game
$game = new Game();
// Set up initial game conditions
$game->setUpGame();

// Display start of game conditions
echo 'Starting game with '.$game->players[0]->getName().', '.$game->players[1]->getName().', '.$game->players[2]->getName().', '.$game->players[3]->getName().PHP_EOL;
echo $game->players[0]->getName().' has been dealt: '.$game->players[0]->getPlayerHand(),PHP_EOL ;
echo $game->players[1]->getName().' has been dealt: '.$game->players[1]->getPlayerHand(),PHP_EOL ;
echo $game->players[2]->getName().' has been dealt: '.$game->players[2]->getPlayerHand(),PHP_EOL ;
echo $game->players[3]->getName().' has been dealt: '.$game->players[3]->getPlayerHand(),PHP_EOL ;
echo 'Top card is: '.end($game->discardPile), PHP_EOL;

// Play turns until the end of the game
while (true){

    // Progress one turn in the game
    $actionResult = $game->playerTakeTurn();
    // Check if game has not finished finished
    if ($actionResult != "END"){
        // Check if the game has finished because it was in an unplayable stage
        if ($actionResult == "ENDINFINITY"){
            // Output end game screen
            echo $game->players[$game->getPreviousPlayerNumber()]->getName().' does not have a suitable card and the deck is empty!'.PHP_EOL;
            echo "Nobody is able to play! Ending the game.".PHP_EOL;
            break;
        }
        // Output action of turn
        echo $actionResult,PHP_EOL; 

    } else {
        // Output final play and victory message
        echo $game->players[$game->turnPointer]->getName().' plays '.end($game->discardPile),PHP_EOL;
        echo $game->players[$game->turnPointer]->getName().' has won.',PHP_EOL;
        break;
    }
}
?>