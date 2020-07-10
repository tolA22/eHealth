<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' =>  $this->name,
            'email'=>$this->email,
            'address'=>$this->address,
            'dob' => $this->dob,
            'phone' => $this->phone,
            'roles'=>$this->roles,
            'api_token'=>$this->api_token
        ];
    }
}
