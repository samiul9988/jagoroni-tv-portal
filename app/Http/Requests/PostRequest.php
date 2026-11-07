<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            'post_title' => 'required|min:3',
            'slug'  => 'sometimes|required',
            // The server's image library (GD) can only decode these formats;
            // anything else (e.g. AVIF) crashes with an unhandled exception
            // instead of a validation error, so reject it up front.
            'post_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp|max:10240',
            'image_url' => 'nullable|url:http,https',
            'division' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'upazila' => 'nullable|string|max:100',
            'publisher_id' => 'nullable|exists:publishers,id'
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'post_image.mimes' => 'Unsupported image format (e.g. AVIF). Please save it as JPG, PNG, GIF, BMP or WebP and upload again.',
        ];
    }
}
