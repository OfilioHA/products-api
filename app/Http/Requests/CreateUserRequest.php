<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user->hasRole('administrador');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['string', 'required', 'unique:users,username'],
            'fullname' => ['string', 'required'],
            'role' => ['string', 'required'],
            'email' => ['string', 'email', 'required', 'unique:users,email'],
            'phone' => ['string', 'required'],
            'photo' => ['file', 'nullable'],
            'username' => ['string', 'required'],
            'password' => ['string', 'required'],
            'gender' => ['required', 'string', 'in:Hombre,Mujer'],
        ];
    }
}
