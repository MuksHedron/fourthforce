<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUserRequest extends FormRequest
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
            'taskroleid' => ['required', 'integer'],
            'userid' => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'Task User ID',
            'taskroleid' => 'Task',
            'userid' => 'User',
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
