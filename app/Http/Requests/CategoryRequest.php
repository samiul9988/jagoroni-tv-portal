<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name'  => ['required', 'min:3', Rule::unique('terms', 'name')->where(function ($query) {
                        return $query->whereTaxonomy('category')->where('language_id', request('language'));
                    })]
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => ['required','min:3', Rule::unique('terms', 'name')->where(function ($query) {
                        return $query->where('taxonomy', 'category');
                    })->ignore($this->name, 'name')]
                ];
            }
            default: break;
        }
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], 422));
    }
}
