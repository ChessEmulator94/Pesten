<?php

class Game {
    
    // Array containing all players in the game (as Player objects)
    public $players;
    // Holds number of players in game
    public $playersCount;
    // Deck object that acts as the draw pile
    public $drawPile;
    // Array holding discsarded cards
    public $discardPile;
    // Index of the person whose turn it is (in $players)
    public $turnPointer;
    // Stores number of consecutive turns without action (draw or play)
    public $unsuccessfulTurns;

    // Default Constructor 
    public function __construct() {

        /* Hard coded Test Data */
        $newPlayer1 = new Player("Alice");
        $newPlayer2 = new Player("Bob");
        $newPlayer3 = new Player("Carol");
        $newPlayer4 = new Player("Eve");
        $players = [$newPlayer1,$newPlayer2,$newPlayer3,$newPlayer4];
        /* Hard coded Test Data */

        $this->players = $players;
        $this->playersCount = count($this->players);
        $this->drawPile = new Deck();
        $this->discardPile = [];
        $this->unsuccessfulTurns = 0;
    }

    // Take a player turn
    public function playerTakeTurn(){
        
        // Get active card
        $topOfDiscard = end($this->discardPile);
       
        // Check if current player can play
        if ($this->players[$this->turnPointer]->canPlay(end($this->discardPile))){

            // Reset unsuccessfulTurns counter;
            $this->unsuccessfulTurns = 0;

            // Play playable card
            $newTopCard = $this->players[$this->turnPointer]->playPlayableCard($topOfDiscard);
            
            // Add the played card to discard pile
            array_push($this->discardPile,$newTopCard);

            // Get new hand size of active player
            $currentPlayerHandSize = $this->players[$this->turnPointer]->getHandSize();

            // Check if game needs to end
            if ($currentPlayerHandSize == 0){
                // Signal to end the game
                return 'END';
            } else {
                // Store the player whose turn is being processed
                $oldPlayerPointer = $this->turnPointer;
                
                // Change turn to next player
                $this->changePlayerTurn();

                // Check if last player who played is on last card
                if ($this->lastCardTrue()){
                    return $this->players[$oldPlayerPointer]->getName().' plays '.$newTopCard.PHP_EOL.$this->players[$oldPlayerPointer]->getName().' has 1 card remaining!';
                }

                // Return the played card
                return $this->players[$oldPlayerPointer]->getName().' plays '.$newTopCard;
            } 
        } else {

            // Check if draw pile still has cards
            if ($this->drawPile->getCardsCount()>0){
                
                // Reset unsuccessfulTurns counter;
                $this->unsuccessfulTurns = 0;

                // If it does, draw a card and add it to the players hand
                $drawnCard = $this->drawPile->removeCard();
               
                // Add the drawn card to the player's hand
                $this->players[$this->turnPointer]->addCard($drawnCard);
            
                $oldPlayerPointer = $this->turnPointer;
                
                // Change turn to next player
                $this->changePlayerTurn();
                

                // Return that no card was played
                return $this->players[$oldPlayerPointer]->getName().' does not have a suitable card, taking from deck '.$drawnCard;
            }
            
            // Store the player whose turn is being processed
            $oldPlayerPointer = $this->turnPointer;
            
            // Change turn to next player
            $this->changePlayerTurn();
            
            // Increment the amount of turns of no play
            $this->unsuccessfulTurns++;

            if ($this->unsuccessfulTurns == 4){
                return "ENDINFINITY";
                //return $this->players[$oldPlayerPointer]->getName().' does not have a suitable card and the deck is empty!'.PHP_EOL.'Nobody is able to play anymore and the deck is empty!'.PHP_EOL;
            }

            // Return that no card was played
            return $this->players[$oldPlayerPointer]->getName().' does not have a suitable card and the deck is empty!';
        } 
    }

    // Set top of discard pile
    public function setTopDiscard($newTopDiscard){
        array_push($this->discardPile,$newTopDiscard);
    }

    // Change the player pointer to next person in game
    public function changePlayerTurn():void{
        // If pointer is pointing to last person, loop to first
        if ($this->turnPointer != $this->playersCount-1){
            $this->turnPointer++;
        } else {
            $this->turnPointer = 0;
        }
    }

    // Change the player pointer to next person in game
    public function getPreviousPlayerNumber(){
            if ($this->turnPointer == 0){
                return $this->playersCount-1;
            } else { 
                return $this->turnPointer-1;
            }
        }

    // Setup start of game conditions
    public function setUpGame():void{

        // Get the initial card for the discard pile
        array_push($this->discardPile,$this->drawPile->removeCard());
        $this->turnPointer = 0;

        // Add 7 cards to each players hand
        foreach ($this->players as $player){
            for ($i = 0; $i<7; $i++){
                $player->addCard($this->drawPile->removeCard());
            }
        }
    }

    // Check if last player who played is now on their last card
    public function lastCardTrue(){

        // Get position of previous player
        $previousPlayerNumber = $this->getPreviousPlayerNumber();

        // Check if their hand size is 1 and return true/false
        if ($this->players[$previousPlayerNumber]->getHandSize() == 1){
            return true;
        } else {
            return false;
        }
    }

}


?>