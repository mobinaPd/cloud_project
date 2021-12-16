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
//        dd($all);
        return view('compareSelGen', compact('all'));
    }
}
