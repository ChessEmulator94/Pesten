<?php

class Deck {

    // Properties

    // Array containing Card objects with remaining cards
    protected $remainingCards;
    // Integer containing the size of $remainingCards
    protected $cardsLeftCount;

    // Get count of remaining cards
    public function getCardsCount(){
        return count($this->remainingCards);
    }

    // Remove a card from the deck
    public function removeCard(){
        $removedCard = array_pop($this->remainingCards);
        return $removedCard;
    }
    
    // Add a card to the deck
    public function addCard($card):void{
        array_push($this->remainingCards,$card);
    }

    // Shuffle the deck
    public function shuffleDeck():void{
        shuffle($this->remainingCards);
    }

    // Get number of remaining cards


    // Constructor
    public function __construct() {
        $this->remainingCards = [];
        $this->cardsLeftCount = 0;
        $this->fillDeck();
        $this->shuffleDeck();
        }    


    // Fill the deck with cards
    public function fillDeck(){

        $allSuits = ['♦️','♥️','♣️','♠️'];

        $allValues = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

        // Iterate over all possible suit/value combinations
        foreach($allSuits as $suit){
            foreach($allValues as $value){
                // Determine colour based on suit
                if ($suit == '♦️' || $suit == '♥️'){
                    $colour = 'red';
                } else {
                    $colour = 'black';
                }

                $tempCard = new Card($suit,$colour,$value);
                $this->addCard($tempCard);
            }
        }
    }



}

?>