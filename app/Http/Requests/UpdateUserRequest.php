<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'username' => ['string', 'required'],
            'fullname' => ['string', 'required'],
            'role' => ['string', 'required'],
            'email' => ['string', 'email', 'required'],
            'phone' => ['string', 'required'],
            'photo' => ['file', 'nullable'],
            'username' => ['string', 'required'],
            'password' => ['string', 'nullable'],
            'gender' => ['required', 'string', 'in:Hombre,Mujer'],
        ];
    }
}
