# High Card Game

## About the game

This game generates an equal amount of cards and for each card you who ever has a higher card will get a point. If the cards are the same, no one will get a point and if the total points are equal then the match is a draw.

For example:

* ***Player Hand:*** 2 5 A -> ***Score:*** 0+0+1=1
* ***Computer Hand:*** 2 6 K -> ***Score:*** 0+1+0=1

On the bottom of the page there is a leaderboard which shows all players grouped by the name with details of how many games they have played and how did they win against the computer

## Steps to steup

* Install Composer
* Add .env with correct credentials to the database
* (In the root directory of the app) ```Type npm run```
* (In the root directory of the app) ```php artisan migrate```
* (In the root directory of the app) ```php artisan serve```

## Future Changes

* The leaderboard should show top 10 players without being grouped by the name
* Creating an auth system so we can store each account and identify distinct users on the leaderboard
* Add Javascript validation for cards on the front-end *(This is currently validated on the back-end)
* Allow User vs User in the future
