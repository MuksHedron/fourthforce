<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentLobRequest extends FormRequest
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
            'documentid' => ['required', 'integer'],
            'sublobid' => ['required', 'integer'], 
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
            'id' => 'Document Lob ID',
            'documentid' => 'Document',
            'sublobid' => 'Sub Lob', 
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
