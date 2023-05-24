<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBeasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('beasiswa_create');
    }

    public function rules()
    {
        return [
            'beasiswaname' => [
                'string',
                'required',
            ],
            'nim' => [
                'string',
                'required',
            ],
            'jenis_kelamin' => [
                'string',
                'required',
            ],
            'jurusan' => [
                'string',
                'required',
            ],
            'fakultas' => [
                'string',
                'required',
            ],
            'jalur' => [
                'string',
                'required',
            ],
        ];
    }
}
