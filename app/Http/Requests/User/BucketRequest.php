<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class BucketRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable',
            'image' => 'nullable|string',
            // 'categories' => 'required|array',
            // 'categories.*' => 'numeric'
            'category' => 'required|string'

        ];
    }
}
