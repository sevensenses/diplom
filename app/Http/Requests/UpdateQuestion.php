<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestion extends FormRequest
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
            'question' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'user_name' => 'required|min:3',
            'user_email' => 'required|email',
            'status_id' => 'required|exists:question_statuses,id',
        ];
    }
}
