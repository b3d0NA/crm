<?php

namespace App\Http\Requests;

use App\Rules\CsvMime;
use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'csv_file' => 'required|file'
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'Please upload a csv file',
            'csv_file.file' => 'Please upload a csv file only',
            'csv_file.mimes' => 'Only CSV file supported',
        ];
    }
}