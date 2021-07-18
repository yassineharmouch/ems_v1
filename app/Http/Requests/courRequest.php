<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class courRequest extends FormRequest
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
            'grp' => 'required',
            'prof' => 'required',
            'module' => 'required',
            'chapitre' => 'required',
            'titre' => 'required',
            'description' => 'required',
            'file'  => 'required'
        ];
    }
}