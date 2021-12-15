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
        $results = DB::connection('mysql2')->select(DB::raw("SELECT * FROM (
            SELECT *, IF(@prev <> `Platform`, @rn:=0,@rn), @prev:= `Platform`, @rn:=@rn+1 AS rn
            FROM `games`, (SELECT @rn:=0) rn, (SELECT @prev:='') prev
            ORDER BY `Platform` ASC, `Rank` ASC
          ) t WHERE rn <= $N"));
        return $results;
    }

    public function bestGameYear($N)
    {

        $results = DB::connection('mysql2')->select(DB::raw("SELECT * FROM (
            SELECT *, IF(@prev <> `Year`, @rn:=0,@rn), @prev:= `Year`, @rn:=@rn+1 AS rn
            FROM `games`, (SELECT @rn:=0) rn, (SELECT @prev:='') prev
            ORDER BY `Year` ASC, `Rank` ASC
          ) t WHERE rn <= $N"));
        return $results;

    }

    public function bestGameGen($N)
    {
        $results = DB::connection('mysql2')->select(DB::raw("SELECT * FROM (
            SELECT *, IF(@prev <> `Genre`, @rn:=0,@rn), @prev:= `Genre`, @rn:=@rn+1 AS rn
            FROM `games`, (SELECT @rn:=0) rn, (SELECT @prev:='') prev
            ORDER BY `Genre` ASC, `Genre` ASC
          ) t WHERE rn <= $N"));
        return $results;

    }

    public function best5($year , $plat)
    {
        $results = DB::connection('mysql2')->select(DB::raw("SELECT * FROM `games` WHERE `Year`= '$year' AND `Platform` = '$plat'
        ORDER BY `Global_Sales` DESC LIMIT 5 "));

        return $results;
    }


    public function euMoreNa()
    {
        $results = DB::connection('mysql2')->select(DB::raw("SELECT * FROM `games` WHERE `NA_Sales` < `EU_Sales` "));
        return $results;
    }


    public function compareSel($g1 , $g2)
    {

        $all = array();

        $result1 = DB::connection('mysql2')->select(DB::raw("SELECT `Name` , `Global_Sales`, `NA_Sales`, `EU_Sales`, `JP_Sales`, `Other_Sales`
        FROM `games` WHERE `Name` = '$g1'"));

        $result2 = DB::connection('mysql2')->select(DB::raw("SELECT `Name` , `Global_Sales`, `NA_Sales`, `EU_Sales`, `JP_Sales`, `Other_Sales`
        FROM `games` WHERE `Name` = '$g2'"));


        array_push( $all, $result1 );
        array_push( $all, $result2 );

        return $all;

    }


    public function totalSel($t1 , $t2)
    {
        $all = array();

        while($t1 <= $t2)
        {

            ${'result' . $t1} = DB::connection('mysql2')->select(DB::raw("SELECT `Year` ,  SUM(`Global_Sales`) FROM `games` WHERE `Year` = '$t1' "));
            array_push( $all, ${'result' . $t1} );
            $t1 ++ ;
        }

        return $all;
    }


    public function compareSelPublisher($p1 , $p2 , $t1 , $t2)
    {
        $all = array();

        while($t1 <= $t2)
        {

            ${'result1' . $t1} = DB::connection('mysql2')->select(DB::raw("SELECT `Publisher` , `Year` ,  SUM(`Global_Sales`) FROM `games`
             WHERE `Year` = '$t1' AND `Publisher` = '$p1' "));

            ${'result2' . $t1} = DB::connection('mysql2')->select(DB::raw("SELECT `Publisher` , `Year` ,  SUM(`Global_Sales`) FROM `games`
            WHERE `Year` = '$t1' AND `Publisher` = '$p2' "));

            array_push( $all, ${'result1' . $t1} );
            array_push( $all, ${'result2' . $t1} );

            $t1 ++ ;
        }

        return $all;
    }


    public function compareSelGen($t1 , $t2)
    {
        $all = array();

        $gens = array("Sports", "Platform", "Racing" , "Role-Playing" , "Puzzle",
        "Misc" , "Shooter", "Simulation" , "Action" , "Fighting", "Adventure" , "Strategy");

        for($i = 0 ; $i< count($gens); $i++)
        {

            $result = DB::connection('mysql2')->select(DB::raw("SELECT `Genre`, SUM(`Global_Sales`) FROM `games`
            WHERE `Year` BETWEEN '$t1' AND '$t2' AND `Genre` = '$gens[$i]' "));


            array_push( $all, $result );
        }

        return $all;
    }

}


