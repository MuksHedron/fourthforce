<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLocRequest extends FormRequest
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
            'usersid' => ['required', 'integer'],
            'locationid' => ['required', 'integer'], 
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'User Location ID',
            'usersid' => 'User Name',
            'locationid' => 'Location', 
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
