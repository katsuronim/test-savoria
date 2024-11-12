<?php

namespace App\Http\Requests;

use App\Models\map_users_apps;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


class MapAppsUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
             $this->validateChoice($validator);
        });
    }

    protected function validateChoice($validator)
    {
        $app_id = $this->input('app_id');
        $user_id = $this->input('user_id');

        $result = map_users_apps::where('app_id', $app_id)->where('user_id', $user_id)->count();

        if ($result > 0) {
            $validator->errors()->add('app_id', 'Hak akses aplikasi yang dipilih untuk pengguna sudah terdaftar');
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'app_id' => ['required'],
            'user_id' => ['required'],
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
            'app_id.required' => 'Data aplikasi harus dipilih',
            'user_id.required' => 'Data pengguna harus dipilih',
            'data_status.required' => 'Data status harus dipilih',
        ];
    }
}
