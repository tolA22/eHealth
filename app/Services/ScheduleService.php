<?php

namespace App\Services;

use App\Repositories\Schedule\ScheduleRepository;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Schedule;

class ScheduleService{

    protected $ScheduleRepository;

    public function __construct(ScheduleRepository $ScheduleRepository){
        $this->ScheduleRepository = $ScheduleRepository;
    }

    public function createModel(array $param){
        $param["patient_id"] = Auth::id();
        return $this->ScheduleRepository->create($param);

    }

    public function all($role){
        
        $scheduleData = $role == 'patient'? ["patient_id"=>Auth::id()]:["doctor_id"=>Auth::id()];
        // dd($this->ScheduleRepository->findByColumn($scheduleData)->orderBy('created_at', 'DESC')->get());
        return $this->ScheduleRepository->findByColumn($scheduleData)->orderBy('created_at', 'DESC')->get();
    }

    public function update(array $param,$id){
        // return "here";
        return $this->ScheduleRepository->update($param,$id);
    }

    public function delete($id){
        return $this->ScheduleRepository->delete($id);
    }

    public static function weeklyStats($id){
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $data = [$weekStartDate,$weekEndDate];
        // dd(Auth::id());
        // dd(Schedule::where('doctor_id',2)->get());
        return Schedule::where('doctor_id',$id)->whereBetween('date_of_visit',$data)->get();
        // return $this->ScheduleRepository->findBetweenDates($data);
    }

    

}