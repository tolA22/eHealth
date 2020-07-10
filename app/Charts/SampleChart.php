<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SampleChart extends BaseChart
{
    
    

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $id = $request["id"];
        $collection = ScheduleService::weeklyStats($id)->groupBy(function($date) {
            return Carbon::parse($date->date_of_visit)->format('l'); 
        });
// dd($collection);
        $total=array_fill(0,7,0);
        $awaitingApproval=array_fill(0,7,0);
        $approved=array_fill(0,7,0);
        $declined=array_fill(0,7,0);
        foreach($collection as $value=>$key){
            if(strtolower($value) == "sunday"){
                $total[0] = count($key);
                $awaitingApproval[0] =$key->where('status','awaiting approval')->count();
                $approved[0] =$key->where('status','approved')->count();
                $declined[0] =$key->where('status','declined')->count();
            }
            if(strtolower($value) == "monday"){
                $total[1] = count($key);
                $awaitingApproval[1] =$key->where('status','awaiting approval')->count();
                $approved[1] =$key->where('status','approved')->count();
                $declined[1] =$key->where('status','declined')->count();
            }
            if(strtolower($value) == "tuesday"){
                $total[2] = count($key);
                $awaitingApproval[2] =$key->where('status','awaiting approval')->count();
                $approved[2] =$key->where('status','approved')->count();
                $declined[2] =$key->where('status','declined')->count();
            }
            if(strtolower($value) == "wednesday"){
                $total[3] = count($key);
                $awaitingApproval[3] =$key->where('status','awaiting approval')->count();
                $approved[3] =$key->where('status','approved')->count();
                $declined[3] =$key->where('status','declined')->count();
            }
            if(strtolower($value) == "thursday"){
                $total[4] = count($key);
                $awaitingApproval[4] =$key->where('status','awaiting approval')->count();
                $approved[4] =$key->where('status','approved')->count();
                $declined[4] =$key->where('status','declined')->count();
            }
            if(strtolower($value) == "friday"){
                $total[5] = count($key);
                $awaitingApproval[5] =$key->where('status','awaiting approval')->count();
                $approved[5] =$key->where('status','approved')->count();
                $declined[5] =$key->where('status','declined')->count();
            }
            if(strtolower($value) == "saturday"){

                $total[6] = count($key);
                $awaitingApproval[6] =$key->where('status','awaiting approval')->count();
                $approved[6] =$key->where('status','approved')->count();
                $declined[6] =$key->where('status','declined')->count();
                // dd($total);
            }
        }
      
        // $total[6] = 2;
        // dd($total);
        return Chartisan::build()
            ->labels(['Sunday','Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday'])
            ->dataset('Total', $total)
            ->dataset('Awaiting Approval',$awaitingApproval)
            ->dataset('Approved', $approved)
            ->dataset('Declined', $declined);
    }
}