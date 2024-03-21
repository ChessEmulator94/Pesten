<?php

class Card {

    // Stores suit of the card (♦️♣️♥️♠️)
    protected $suit;
    // Stores card colour (black/red)
    protected $colour;
    // Stores card value (A-K)
    protected $value;

    // Get card as a string 
    public function __toString(){
        return $this->getSuit().$this->getValue();
    }

    // get card colour
    public function getColour() {
        return $this->colour;
    }

    // get card value
    public function getValue() {
        return $this->value;
    }

    // get card value
    public function getSuit() {
        return $this->suit;
    }

    // Set card suit
    public function setSuit($suit):void {
        $this->suit = $suit;
    }

    // Set card suit
    public function setValue($value):void {
        $this->value = $value;
    }

    // Set card suit
    public function setColour($colour):void {
        $this->colour = $colour;
    }

    // Constructor
    public function __construct($suit,$colour,$value) {
        $this->setSuit($suit);
        $this->setColour($colour);
        $this->setValue($value);
      }
}

?>