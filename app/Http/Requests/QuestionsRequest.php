<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'sublobid' => ['required', 'integer'],
            'questiongroup' => ['required', 'string'],
            'questionid' => ['required', 'integer'],
            'question' => ['required', 'string'],
            'type' => ['required', 'string'],
            'mandatory' => ['required', 'integer'],
            'jumpto' => ['required', 'integer'],
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
            'id' => 'Question ID',
            'sublobid' => 'Sub Lob',
            'questiongroup' => 'Question Group',
            'questionid' => 'Question ID',
            'question' => 'Question',
            'type' => 'Type',
            'mandatory' => 'Mandatory',
            'jumpto' => 'Jump To',
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
