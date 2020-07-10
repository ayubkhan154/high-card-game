# High Card Game

## About the Game

This game generates an equal amount of cards and for each card who ever has the higher card will get a point. If the cards are the same, no one will get a point and if the total points are equal then the match is a draw.

For example:

*Player Hand* | *Computer Hand* | *Player Score* | *Computer Score*
-------------------|-------------------|----------|----------
2 5 A | 2 6 K | 1 | 1
A K A | 2 3 4 | 3 | 0
10 K J | A Q 9 | 2 |  1

On the bottom of the page there is a leaderboard which shows all players grouped by the name with details of how many games they have played and how did they win against the computer

## Input Restrictions

* A user can't not enter more than 26 cards
* The card should be entered with a space for example *A K* 
* The card should be from the list *A K Q J 10 9 8 7 6 5 4 3 2*

## Steps to Setup

* Clone the repository locally
* Add .env with correct credentials to the database
* (In the root directory of the app) ```Composer install```
* (In the root directory of the app) ```npm run```
* (In the root directory of the app) ```php artisan migrate```
* (In the root directory of the app) ```php artisan serve```

## Future Changes

* The leaderboard will show top 10 players without being grouped by the name
* Creating an auth system so we can store each account and identify distinct users on the leaderboard
* Add Javascript validation for cards on the front-end *(This is currently validated on the back-end)
* Allow User vs User in the future
