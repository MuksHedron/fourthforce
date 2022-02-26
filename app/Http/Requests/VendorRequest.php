<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'shortname' => ['required', 'string'],
            'name' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'email' => ['required', 'string'],
            'mobile' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'pincode' => ['required', 'numeric'],
            'cityid' => ['required', 'integer'],
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
            'id' => 'Vendor ID',
            'shortname' => 'Short Name',
            'name' => 'Vendor Name',
            'contact' => 'Contact',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'pincode' => 'Pincode',
            'cityid' => 'City',
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
