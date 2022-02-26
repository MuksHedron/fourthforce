<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'categoryid' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'shortname' => ['required', 'string'],
            'address' => ['required', 'string'],
            'cityid' => ['required', 'integer'],
            'stateid' => ['required', 'integer'],
            'pincode' => ['required', 'integer'],
            'contactname' => ['required', 'string'],
            'tele1' => ['required', 'integer'],
            'tele2' => ['required', 'integer'],
            'email1' => ['required', 'string'],
            'email2' => ['required', 'string'],
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
            'id' => 'Client ID',
            'name' => 'Client Name',
            'shortname' => 'Short Name',
            'address' => 'Address',
            'cityid' => 'City',
            'stateid' => 'State',
            'pincode' => 'Pincode',
            'contactname' => 'Contact Name',
            'tele1' => 'Telephone 1',
            'tele2' => 'Telephone 2',
            'email1' => 'Email 1',
            'email2' => 'Email 2',
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
