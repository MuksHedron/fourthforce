<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLobRequest extends FormRequest
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
            'userid' => ['required', 'integer'],
            'sublobid' => ['required', 'integer'], 
        ];
    }
    public function attributes()
    {
        return [
            'id' => 'User Lob ID',
            'userid' => 'User Name',
            'sublobid' => 'SUb Lob Name', 
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
