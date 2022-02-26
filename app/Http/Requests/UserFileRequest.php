<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFileRequest extends FormRequest
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
          'fileid' => ['required', 'integer'],
          'userid' => ['required', 'integer'],  
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'User Case ID',
            'fileid' => 'Case Name',
            'userid' => 'User Name', 
            'status' => 'Status',
        ];
    }


    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
        ];
    }
}
