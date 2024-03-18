<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdvertisementRequest extends FormRequest
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
                    'name'   => 'required|unique:advertisement',
                    'width'  => 'required_if:type,image',
                    'height' => 'required_if:type,image',
                    'image'  => 'mimes:jpeg,png,gif|file|max:1000|dimensions:max_width=1000,max_height=1000'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'   => 'required|unique:advertisement,name, ' .  $this->advertisement  . ',id',
                    'width'  => 'required_if:type,image',
                    'height' => 'required_if:type,image',
                    'image'  => 'mimes:jpeg,png,gif|file|max:1000|dimensions:max_width=1000,max_height=1000'
                ];
            }
            default: break;
        }
    }
}
