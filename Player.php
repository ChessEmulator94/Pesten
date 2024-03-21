<?php

class Player {

    // Properties
    protected $name;
    protected $hand;
    protected $handSize;

    // Constructor
    public function __construct($name) {
        $this->setName($name);
        $this->hand = [];
        $this->handSize = 0;
        }

    // Set player name
    public function setName($name):void{
        $this->name = $name;
    }

    // Get player name
    public function getName(){
        return $this->name;
    }

    // Add a card to hand
    public function addCard($card):void{
        array_push($this->hand,$card);
        $this->handSize++;
    }

    // Remove a card from hand
    public function removeCard($card):void{
        $cardPosition = array_search($card,$this->hand);
        array_splice($this->hand, $cardPosition, 1);
    }

    // Return handSize
    public function getHandSize(){
        return $this->handSize;
    }

    // Determines if hand contains a playable card
    public function canPlay($topCardOfDeck){
        
        // Iterate over all cards in the players hand
        foreach ($this->hand as $card){
            // Check if card is playable based on suit
            if ($card->getSuit() == $topCardOfDeck->getSuit()){
                return true;
            } 
            // Check if card is playable based on value
            if ($card->getValue() == $topCardOfDeck->getValue()){
                return true;
            }   
        }
        // No playable card found
        return false;
    }


    // Return the players hand as a string
    public function getPlayerHand(){
        $stringOfCards = '';
        foreach ($this->hand as $card){
            $stringOfCards = $stringOfCards . $card->__toString() . ' ';
        }
        return $stringOfCards;
    }

    // Find a card to play and play it
    public function playPlayableCard($topCardOfDeck){

        foreach ($this->hand as $card){
            // Check if card is playable based on suit
            if ($card->getSuit() == $topCardOfDeck->getSuit()){
                $returnCard = $card;
                $this->removeCard($card);
                $this->handSize--;
                return $returnCard;
            } 
            // Check if card is playable based on value
            if ($card->getValue() == $topCardOfDeck->getValue()){
                $returnCard = $card;
                $this->removeCard($card);
                $this->handSize--;
                return $returnCard;
            } 
        }
    }    
}

?>