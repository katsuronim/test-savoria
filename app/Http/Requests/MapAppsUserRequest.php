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
            $this->validateChoices($validator);
        });
    }

    protected function validateChoices($validator)
    {
        $app_ids = $this->input('app_ids', []);
        $user_id = $this->input('user_id');

        foreach ($app_ids as $app_id) {
            $exists = map_users_apps::where('app_id', $app_id)->where('user_id', $user_id)->exists();
            $data = map_users_apps::join('apps', 'map_users_apps.app_id', '=', 'apps.app_id')
                                    ->join('users', 'map_users_apps.user_id', '=', 'users.user_id')
                                    ->where('map_users_apps.app_id', $app_id)
                                    ->where('map_users_apps.user_id', $user_id)
                                    ->first();

            if ($exists) {
                $validator->errors()->add('app_ids', 'Hak akses untuk aplikasi dengan nama aplikasi ' . $data->app_name . ' sudah terdaftar untuk pengguna ' . $data->user_fullname);
            }
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
            'app_ids' => ['required', 'array', 'min:1'],  // Ensure at least one checkbox is selected
            'app_ids.*' => ['exists:apps,app_id'],        // Ensure each selected app_id exists in the apps table
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
            'app_ids.required' => 'Setidaknya satu aplikasi harus dipilih.',
            'app_ids.*.exists' => 'Aplikasi yang dipilih tidak valid.',
            'user_id.required' => 'Data pengguna harus dipilih.',
            'data_status.required' => 'Data status harus dipilih.',
        ];
    }
}
