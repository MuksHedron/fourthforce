<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'id' => ['required', 'integer'],
            'clientid' => ['required', 'integer'],
            'typeid' => ['required', 'integer'],
            'hubid' => ['required', 'integer'],
            'stateid' => ['required', 'integer'],
            'cityid' => ['required', 'integer'],
            'locationid' => ['required', 'integer'],
            'policyno'  => ['required', 'string'],
            'name' => ['required', 'string'],
            'dob' => ['nullable', 'date', 'before:today'],
            'fathername' => ['nullable', 'string'],
            'address' => ['required', 'string'],
            'pincode' => ['required', 'integer', 'min:6'],
            'mobile1' => ['nullable', 'integer', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/'],
            'mobile2' => ['nullable', 'integer', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/'],
            'email' => ['nullable', 'string', 'email', 'max:255',],
            'receivedon' => ['nullable', 'date', 'before:today'],

            'reflabel' => ['required', 'integer'],
            'otherreflabel' => ['nullable', 'integer'],

            'nominee' => ['nullable', 'string'],
            'relationid' => ['nullable', 'integer'],
            'agent' => ['nullable', 'string'],

            // 'filestatus' => ['required', 'string'],            
            // 'status' => ['required', 'integer'],
            // 'crby' => ['required', 'integer'],
            // 'dtcr' => ['required', 'date'],
            // 'lmby' => ['required', 'integer'],
            // 'dtlm' => ['required', 'date'],
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'Case ID',
            'type' => 'Case Type',
            'reflabel' => 'Customer Reference Label',
            'policyno' => 'Customer Reference Number',
            'name' => 'Name',
            'address' => 'Address',
            'location' => 'Location',
            'city' => 'City',
            'state' => 'State',
            'pincode' => 'Pincode',
            'tele' => 'Telephone',
            'mobile' => 'Mobile',
            'mail' => 'Mail',
            'policyref' => 'Policy Ref',
            'claimref' => 'Claim Ref',
            'incidentdate' => 'Incident Date',
            'incidentreported' => 'Incident Reported',
            'incidentlocation' => 'Incident Location',
            'vehicleno' => 'Vehicle No',
            'client' => 'Client',
            'filestatus' => 'File Status',
            'status' => 'Status',
            'crby' => 'Created By',
            'dtcr' => 'Date of Creation',
            'lmby' => 'Last Modified By',
            'dtlm' => 'Date Of Last Modification',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
        ];
    }
}
