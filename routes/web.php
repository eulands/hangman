<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Game;
use App\Word;
use App\Turn;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create', 'CreateController@index')->name('create');
//Route::post('/create', 'CreateController@start')->name('start');
Route::post('/create', function (Request $request) {
		$word = Word::where('category_id', '=', $request->category_id)->inRandomOrder()->first();
		$game = new Game;
		$game->user_id = Auth::id();
		$game->word_id = $word->id;
		$game->result = 0;
		$game->save();

		return redirect('/home');
});
Route::post('/turn', function (Request $request) {
		$game = Game::where([['user_id', '=', \Auth::user()->id],['result', '<', 5]])->orderBy('id', 'desc')->first();
		$lastTurn = Turn::where('game_id', '=', $game->id)->orderBy('id', 'desc')->first();
		$turn = new Turn;
		$turn->game_id = $game->id;
		if ( is_null($lastTurn)) $turn->turn=1; 
		else $turn->turn = $lastTurn->turn + 1;
		$turn->choice = $request->letter;
		$turn->save();

		return redirect('/home');
});

Route::get('/statistics', 'HomeController@statistics')->name('statistics');