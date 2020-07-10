<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;
use App\Services\ScheduleService;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ScheduleResources;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    use ResponseTrait;

    protected $ScheduleService,$UserService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScheduleService $ScheduleService,UserService $UserService)
    {
        // $this->middleware('auth');
        $this->ScheduleService = $ScheduleService;
        $this->UserService = $UserService;
    }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            
            return view('home');
    }

    public function all()
    {
        if(Auth::user()->hasRole('patient')){
            $data = $this->ScheduleService->all('patient');
            $doctors = $this->UserService->roles("doctor");

            return view('home')->with('data',$data)->with("doctors",$doctors);
        }
        // dd("here");
        $data = $this->ScheduleService->all('doctor');
        return view('doctors.home')->with('data',$data);

    }

    public function allSchedules()
    {
        if(Auth::user()->hasRole('patient')){
            $data = $this->ScheduleService->all('patient');

            
        }else{
            $data = $this->ScheduleService->all('doctor');

        }
        return $this->success("Schedules Fetched Successfully",ScheduleResources::collection($data),$this->code200);

    }


    public function update(Request $request,$id){
        $data = $request->all();
        $schedule = $this->ScheduleService->update($data,$id);
        return $this->success("Schedule Updated Successfully",new ScheduleResources($schedule),$this->code201);
    }

    public function delete($id){
        $schedule = $this->ScheduleService->delete($id);
        return $this->success("Schedule Deleted Successfully",$schedule,$this->code201);
    }

    public function create(Request $request){
        $rules = array (
            'doctor_id' => 'required',
            'reason' => 'required',
            'date_of_visit' => 'required',
    );
    $validator = Validator::make ( $request->all (), $rules );
    if ($validator->fails ())
        return $this->error(( array (             
                'errors' => $validator->getMessageBag ()->toArray () 
        ) ),$this->code422);
    else {
        
       $schedule = $this->ScheduleService->createModel($request->all());
       return $this->success("Schedule Created Successfully",new ScheduleResources($schedule),$this->code200); 
    }
    }

    public function approve($id){
        $schedule = $this->ScheduleService->update(["status"=>'approved'],$id);
        return $this->success("Schedule Approved Successfully",new ScheduleResources($schedule),$this->code201); 

    }

    public function decline($id){
        $schedule = $this->ScheduleService->update(["status"=>'declined'],$id);
        return $this->success("Schedule Declined Successfully",new ScheduleResources($schedule),$this->code201); 

    }
}
