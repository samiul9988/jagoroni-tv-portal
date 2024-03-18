<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'name'     => 'required|string|min:3|max:100',
                    'username' => 'required|string|min:3|max:100|unique:users,username|alpha_dash',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|min:6|confirmed',
                    'role'     => 'required|exists:roles,name'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'       => 'required|string|min:2|max:100',
                    'username'   => 'required|string|min:3|max:100|unique:users,username, ' . $this->user . ',id|alpha_dash',
                    'email'      => 'required|email|unique:users,email, ' . $this->user . ',id',
                    'password'   => 'nullable|min:6|confirmed',
                    'role'       => 'required',
                ];
            }
            default: break;
        }
    }
}
