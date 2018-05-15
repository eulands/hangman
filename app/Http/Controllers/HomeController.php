<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Turn;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = Game::where([['user_id', '=', \Auth::user()->id],['result', '<', 5]])->orderBy('id', 'desc')->first();
		if (!is_null($game)){
			$word = \DB::table('words')->where('id', $game->word_id)->first();
			$lastTurn = Turn::where('game_id', '=', $game->id)->orderBy('id', 'desc')->first();

			$inside = substr(substr($word->word, 1), 0, -1);
			$insideArr = str_split($inside);
			$insideShown="";
			$rightTurn=0;
			foreach($insideArr as $letter){
				$turn = \DB::table('turns')->where([['game_id', $game->id],['choice', 'like', $letter]])->get();
				if (count($turn)) {$insideShown.=$letter; $rightTurn += 1; } else $insideShown.="_";
				}
			
			$word->shown = substr($word->word,0,1).$insideShown.substr($word->word, -1) ;
			
			$word->result_text="";
			if ($rightTurn >= count($insideArr)){
				$word->result_text="You WIN !";
				\DB::table('games')->where('id', $game->id)->update(['result' => 6]);
				}
				
			if (!is_null($lastTurn))
			if (($lastTurn->turn - $rightTurn) >= 5){
				$word->result_text="You LOST !";
				\DB::table('games')->where('id', $game->id)->update(['result' => 5]);
				}
			
			if (is_null($lastTurn)) $word->last_turn=0;
			else $word->last_turn = $lastTurn->turn;
			$word->right_turn = $rightTurn;
			return view('home', ['word' => $word],['letters' => range('A', 'Z')]);
			}
		else 
			return redirect('/create');
    }

    public function create()
    {
        $categories = Category::orderBy('category', 'asc')->get();

		return view('create', [
			'categories' => $categories
			]);
    }

    public function statistics()
    {
        $lost=0;
		$games_lost = Game::where([['user_id', '=', \Auth::user()->id],['result', '=', 5]])->orderBy('id', 'desc')->get();
		if (!is_null($games_lost)) $lost += count($games_lost);
		
		$win=0;
		$games_win = Game::where([['user_id', '=', \Auth::user()->id],['result', '=', 6]])->orderBy('id', 'desc')->get();
		if (!is_null($games_win)) $win += count($games_win);
		
		return view('statistics', ['win' => $win],['lost' => $lost]);
    }	
}
