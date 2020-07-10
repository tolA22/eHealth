<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'reason'=>$this->reason,
            'date'=>$this->date_of_visit,
            'doctor'=>$this->doctor->name,
            'patient'=>$this->patient->name,
            'status'=> $this->status

        ];
    }
}
