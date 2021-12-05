<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(){
        return Game::all();
    }
    public function rank($rank){
        return Game::where('Rank', $rank)->get();
    }

    public function name($name){
        return Game::where("Name","LIKE", "%" . $name . "%")->get();

    }

    // public function bestGamePlat($N){
    //     return Game::select('Name')->groupBy('Platform')->orderBy('Rank', 'desc')->limit($N)->get();

    // }

    // public function bestGameYear($N){
    //     return DB::table('games')->select('Name')->groupBy('Year')->orderBy('Rank', 'desc')->limit($N)->get();

    // }

    // public function bestGameGen($N){
    //     return DB::table('games')->select('Name')->groupBy('Genre')->orderBy('Rank', 'desc')->limit($N)->get();

    // }


    // public function best5($year , $plat){
    //     return DB::table('games')->select('Name')->groupBy('Platform')->where('Year', '=', $year)->where('Platform', '=', $plat)
    //     -> orderBy('Global_Sales', 'desc')->limit(5)->get();

    //     // SELECT * FROM `games`
    //     // WHERE `Year` = 2006 AND `Platform` = "Wii"
    //     // ORDER BY `Global_Sales`
    //     // LIMIT 5

    // }

    // public function euMoreNa(){
    //     return Game::select('Name')->where('NA_Sales','>','EU_Sales')->get();
    //     // SELECT `Name` FROM `games` WHERE `NA_Sales` < `EU_Sales`

    // }

}
