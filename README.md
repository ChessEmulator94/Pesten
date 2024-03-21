# Pesten Card Game Simulation

This project is a simulation of the Dutch card game **_Pesten_**. It consists of several PHP classes that work together to create and manage the game.

## Classes

### `Card`

This class represents a single playing card. It has properties for the suit (♦️♣️♥️♠️), color (red or black), and value (A-K). It provides methods for getting and setting these properties, as well as a `__toString()` method for converting the card to a string representation.

### `Deck`

The `Deck` class manages the deck of cards (`Card` objects). It has properties for the remaining cards and the count of cards left. It provides methods for adding and removing cards, shuffling the deck, and filling the deck with a complete set of cards.

### `Player`

The `Player` class represents a player in the game. It has properties for the player's name and hand (an array of `Card` objects). It provides methods for adding and removing cards from the hand, checking if the player has a playable card based on the top card of the discard pile, and playing a playable card.

### `Game`

The `Game` class manages the overall game logic. It has an array for players (of `Player` objects), draw pile (a `Deck` object), discard pile, turn pointer, and the number of unsuccessful turns (used for tracking if the game is in an unprogressable state). It provides methods for setting up the game, taking a player's turn, changing the turn to the next player, and checking if the last player who played is on their last card.

### `Driver`

The `Driver.php` file is the entry point of the program. It includes all the necessary classes, initializes a new `Game` object, sets up the initial game conditions, and then runs the game loop until the game ends, either due to a player winning or a draw occurring).

## Installation

1. Make sure you have PHP installed on your system.
2. Clone or download this repository to your local machine.

## Running the Game

1. Open a terminal or command prompt and navigate to the directory where you downloaded or cloned the repository.
2. Run the following command to start the game: `php Driver.php`
3. The game progress and actions taken by the players will be displayed in the terminal or command prompt.
