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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $playerData =  new PlayerData;
        $compScore = 0;
        $userScore = 0;
        $generatedHand = [];
        
        $userHand = explode(" ", trim($request->data['userHand']));

        //if the user entered hand exceeds 26 cards then return error specifying what could have went wrong
        if (count($userHand) > 26) {
            return response('You can\'t have more than 26 cards in your hand', 400)->header('Content-Type', 'text/plain');
        }
        
        //if the user entered the cards in a wrong format return an error specifying what could have went wrong
        foreach ($userHand as $card) {
            if (!in_array($card, self::$cards)) {
                return response('The hand you entered is invalid 😟, please make sure you follow the above given instructions and all cards are seperated with a space 😀', 400)
                    ->header('Content-Type', 'text/plain');
            } else {
                $compCard = self::$cards[array_rand(self::$cards)];
                array_push($generatedHand, $compCard);
                if ($card < $compCard) {
                    $compScore++;
                } elseif ($card > $compCard) {
                    $userScore++;
                }
            }
        }
        
        //setting values to insert in db
        $playerData->name = trim($request->data['name']);
        $playerData->userScore = $userScore;
        $playerData->compScore = $compScore;
        $playerData->userWon = $userScore > $compScore ? 1 : 0;
        
        if ($playerData->save()) {
            
            // Send successful response if saved
            return response()->json([
                'generatedHand' => implode(" ", $generatedHand),
                'userScore' => $userScore,
                'compScore' => $compScore,
                'userWon' => $userScore > $compScore ? 1 : 0
            ]);
        } else {
            //return if there was an issue inserting the values in db
            return response('Failed to insert data', 500)->header('Content-Type', 'text/plain');
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
        $results = PlayerData::select('name', PlayerData::raw('count(*) as total'), PlayerData::raw('sum(userWon) as userWon'))
            ->groupBy('name')
            ->orderBy('userWon', 'DESC')
            ->get();

        return $results;
    }
}
