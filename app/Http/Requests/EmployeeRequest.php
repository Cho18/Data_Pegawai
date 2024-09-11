<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'profile'           => 'required',
            'name'              => 'required|string|max:255',
            'gender'            => 'required|in:Laki-laki,Perempuan',
            'address'           => 'required|string',
            'division'          => 'required|in:Marketing,HRD,Finance,Creative,Operasional,IT',
            'level'             => 'required|in:Manager,Staff',
            'position'          => 'required|string',
            'salary'            => 'required|numeric',
            'hire_date'         => 'required|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'profile.required'          => 'Foto profil wajib diunggah',
            'name.required'             => 'Nama pegawai wajib diisi',
            'gender.required'           => 'Jenis kelamin wajib dipilih',
            'address.required'          => 'Alamat wajib diisi',
            'division.required'         => 'Divisi wajib dipilih',
            'level.required'            => 'Level pegawai wajib dipilih',
            'position.required'         => 'Jabatan pegawai wajib diisi',
            'salary.required'           => 'Gaji pegawai wajib diisi dan dalam format angka',
            'hire_date.required'        => 'Tanggal bergabung wajib diisi',
        ];
    }
}
