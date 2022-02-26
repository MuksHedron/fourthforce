<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'clientid' => $this->clients->name,
            'typeid' => $this->sublobs->name,
            'hubid' => $this->hubs->name,
            'stateid' => $this->states->name,
            'cityid' => $this->cities->name,
            'locationid' => $this->locations->name,
            'policyno' => $this->policyno,
            'name' => $this->name,
            'dob' => $this->dob,
            'fathername' => $this->fathername,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'mobile1' => $this->mobile1,
            'mobile2' => $this->mobile2,
            'email' => $this->email,
            'receivedon' => $this->receivedon,
            'nominee' => $this->nominee,
            'relationid' => $this->relations->tag,
            'agent' => $this->agent,
            'filestatusid' => $this->lookups->tag,
            'status' => $this->status,
            'dtcr' => $this->dtcr,
            'crby' => $this->users->name,
            'dtlm' => $this->dtlm,
            'lmby' => $this->users->name
        ];
    }
}
