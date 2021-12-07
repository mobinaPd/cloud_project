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

    public function bestGamePlat($N)
    {
        $results = DB::select(DB::raw("SELECT * FROM (
            SELECT *, IF(@prev <> `Platform`, @rn:=0,@rn), @prev:= `Platform`, @rn:=@rn+1 AS rn
            FROM `games`, (SELECT @rn:=0) rn, (SELECT @prev:='') prev
            ORDER BY `Platform` ASC, `Rank` ASC
          ) t WHERE rn <= $N"));
        return $results;
    }

    public function bestGameYear($N)
    {

        $results = DB::select(DB::raw("SELECT * FROM (
            SELECT *, IF(@prev <> `Year`, @rn:=0,@rn), @prev:= `Year`, @rn:=@rn+1 AS rn
            FROM `games`, (SELECT @rn:=0) rn, (SELECT @prev:='') prev
            ORDER BY `Year` ASC, `Rank` ASC
          ) t WHERE rn <= $N"));
        return $results;

    }

    public function bestGameGen($N)
    {
        $results = DB::select(DB::raw("SELECT * FROM (
            SELECT *, IF(@prev <> `Genre`, @rn:=0,@rn), @prev:= `Genre`, @rn:=@rn+1 AS rn
            FROM `games`, (SELECT @rn:=0) rn, (SELECT @prev:='') prev
            ORDER BY `Genre` ASC, `Genre` ASC
          ) t WHERE rn <= $N"));
        return $results;

    }

    public function best5($year , $plat)
    {
        $results = DB::select(DB::raw("SELECT * FROM `games` WHERE `Year`= '$year' AND `Platform` = '$plat'
        ORDER BY `Global_Sales` LIMIT 5 "));

        return $results;
    }

    public function euMoreNa()
    {
        $results = DB::select(DB::raw("SELECT * FROM `games` WHERE `NA_Sales` < `EU_Sales` "));
        return $results;
    }

}
