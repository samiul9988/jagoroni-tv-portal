<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
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
                    'language' => 'required',
                    'country' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'language' => 'required|string|unique:languages,name,' .  $this->language  . ',name',
                ];
            }
            default: break;
        }
    }
}
