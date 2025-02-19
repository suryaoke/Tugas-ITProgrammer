<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokterUpdateRequest extends FormRequest
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
            'nama' => [
                'required',
                'string',
                'max:200',
                'unique:dokters,nama,' . $this->dokter->id
            ],
            'spesialisasi' => ['required', 'string', 'max:200',],
            'no_telepon' => ['required', 'string', 'max:200',],
        ];
    }
}
