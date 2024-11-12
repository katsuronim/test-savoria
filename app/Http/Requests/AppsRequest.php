<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppsRequest extends FormRequest
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
            'app_code' => ['required', 'unique:apps,app_code,' . $this->route('id') . ',app_id'],
            'app_name' => ['required'],
            'app_group' => ['required'],
            'app_url' => ['required'],
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
            'app_code.required' => 'Kode aplikasi harus diisi',
            'app_code.unique' => 'Kode aplikasi harus unik',
            'app_group.required' => 'Group aplikasi harus diisi',
            'app_url.required' => 'URL aplikasi harus diisi',
            'data_status.required' => 'Data status harus dipilih',
        ];
    }
}
