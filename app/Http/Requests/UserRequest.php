<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_code' => ['required', 'unique:Users,user_code,' . $this->route('id') . ',user_id'],
            'user_fullname' => ['required'],
            'departement' => ['required'],
            'user_password' => ['required'],
            'data_status' => ['required'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'user_code.required' => 'Kode pengguna harus diisi',
            'user_code.unique' => 'Kode pengguna harus unik',
            'departement.required' => 'Departemen pengguna harus diisi',
            'user_password.required' => 'Password pengguna harus diisi',
            'data_status.required' => 'Data status harus dipilih',
        ];
    }
}
