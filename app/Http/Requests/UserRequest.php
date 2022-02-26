<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'code' => ['required','string'],
            'parentid' => ['integer'],
            'name' => ['required', 'string', 'max:255'],
            'token' => ['nullable'], 
            'login' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users', 'email')->ignore($this->user)],            
            'email_verified_at' => ['nullable'],
            'mobile' => ['required','integer'],            
            'clientid' => ['required','integer'],
            'vendorid' => ['required','integer'],
            'password' => ['required', 'string'],
            'kycdata' => ['required', 'string'],
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
            'id' => 'User ID',
            'code' => 'Code',
            'parentid' => 'Parent',
            'name' => 'User Name',           
            'login' => 'Login', 
            'email' => 'Email Address',    
            'email_verified_at' => 'Email Verified At',       
            'mobile' => 'Mobile No',
            'clientid' => 'Client', 
            'vendorid' => 'Vendor ID',                 
            'password' => 'Password',
            'token' => 'Token',  
            'kycdata' => 'KYC Data',  
            'status' => 'Status', 
            'crby' => 'Created By',
            'dtcr' => 'Date of Creation',
            'lmby' => 'Last Modified By',
            'dtlm' => 'Date Of Last Modification',
        ];
    }


}
