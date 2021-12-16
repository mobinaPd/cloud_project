<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function compareSelGen($t1 , $t2)
    {
        $all = array(0,0,0,0,0,0,0,0,0,0,0,0);

        $gens = array("Sports", "Platform", "Racing" , "Role-Playing" , "Puzzle",
            "Misc" , "Shooter", "Simulation" , "Action" , "Fighting", "Adventure" , "Strategy");

        for($i = 0 ; $i< count($gens); $i++)
        {

            $result = DB::connection('mysql2')->select(DB::raw("SELECT SUM(`Global_Sales`) FROM `games`
            WHERE `Year` BETWEEN '$t1' AND '$t2' AND `Genre` = '$gens[$i]' "));

            $all[$i] = $result[0]->{'SUM(`Global_Sales`)'};

        }

        return view('compareSelGen', compact('all'));
    }



    public function totalSel($t1 , $t2)
    {
        $all = array();
        $label = array();

        while($t1 <= $t2)
        {

            $result = DB::connection('mysql2')->select(DB::raw("SELECT `Year` ,  SUM(`Global_Sales`) FROM `games` WHERE `Year` = '$t1' "));
            array_push( $all, $result[0]->{'SUM(`Global_Sales`)'});
            array_push( $label, $result[0]->{'Year'});

            $t1 ++ ;
        }

        return view('totalSel', compact('all' , 'label'));
        return $all;
    }
}



