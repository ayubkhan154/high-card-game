<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\PlayerData;
use App\Http\Resources\CardGame as CardGameResource;

class PlayerController extends Controller
{
    public static $cards = ['2', '3', '4' ,'5', '6', '7' ,'8' ,'9', '10', 'J', 'Q', 'K', 'A'];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamesPlayed = PlayerData::paginate(15);

        return CardGameResource::collection($gamesPlayed);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $playerData =  new PlayerData;
        
        $userHand = explode(" ", trim($request->data['userHand']));

        if (count($userHand) > 26) {
            return response('You can\'t have more than 26 cards in your hand', 400)
                    ->header('Content-Type', 'text/plain');
        }

        $validateHand = self::validateHand($userHand);

        if (!$validateHand) {
            return response('The hand you entered is invalid', 400)
                    ->header('Content-Type', 'text/plain');
        }
        
        $generatedHand = self::generateCompHand($userHand);
        
        $calculateScores = self::calculateScore($userHand, $generatedHand);

        $playerData->name = $request->data['name'];
        $playerData->userScore = $calculateScores['userScore'];
        $playerData->compScore = $calculateScores['compScore'];
        $playerData->userWon = $playerData->userScore > $playerData->compScore ? 1 : 0;

        $returnData = [
            'generatedHand' => implode(" ", $generatedHand),
            'userScore' => $calculateScores['userScore'],
            'compScore' => $calculateScores['compScore'],
            'userWon' => $playerData->userScore > $playerData->compScore ? 1 : 0
        ];

        if ($playerData->save()) {
            //send success message
            return response()->json($returnData);
        } else {
            //return if there was an issue inserting the values in db
            return response('Failed to insert data', 500)
                  ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $topTen = PlayerData::where('userWon', '=', '1')
            ->where('userScore', '>', 'compScore')
            ->orderBy('userScore', 'desc')
            ->limit(10)
            ->get();

        return $topTen;
    }

    public static function calculateScore($userHand, $compHand)
    {
        $scores = [
            'userScore' => 0,
            'compScore' => 0
            ];

        for ($i = 0; $i < count($userHand); $i++) {

            //If the cards are the same, there will be no points added for both players
            if (array_search($userHand[$i], self::$cards) < array_search($compHand[$i], self::$cards)) {
                $scores['compScore']++;
            } elseif (array_search($userHand[$i], self::$cards) > array_search($compHand[$i], self::$cards)) {
                $scores['userScore']++;
            }
        }
        return $scores;
    }

    public static function validateHand($hand)
    {
        foreach ($hand as $card) {
            if (!in_array($card, self::$cards)) {
                return false;
            }
        }
        return true;
    }

    public static function generateCompHand($userHand)
    {
        $generatedHand= [];

        for ($i=0; $i < count($userHand); $i++) {
            $generatedHand[$i] = self::$cards[array_rand(self::$cards)];
        }

        return $generatedHand;
    }
}

// leaderboard
// add if statement for leader if no users
