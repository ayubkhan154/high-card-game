<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\PlayerData;
use App\Http\Resources\CardGame as CardGameResource;

class PlayerController extends Controller
{
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
        $playerHand = null;

        if ($request->isMethod('put')) {
            $playerHand =  new PlayerData;
        }
        
        $playerHand->name = $request->data->input('name');
        $playerHand->score = $request->data->input('userScore');
        $playerHand->compScore = $request->data->input('compScore');
        $playerHand->userWon = $request->data->input('userWon');

        if ($playerHand->save()) {
            return "passed";
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
            ->where('userScore', '>', 'compScoe')
            ->orderBy('userScore', 'desc')
            ->limit(10)
            ->get();

        return $topTen;
    }
}
