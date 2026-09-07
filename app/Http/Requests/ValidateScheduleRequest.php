<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateScheduleRequest extends FormRequest
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
     */
    public function rules(): array
    {

        return [
            'class_type_id' => [
                'required',
                'integer',
                'exists:class_types,id',
            ],

            'date' => [
                'required',
                'date',
            ],

            'time' => [
                'required',
                'date_format:H:i',
            ],

        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'class_type_id.required' => 'Please select a class type.',
            'class_type_id.exists' => 'The selected class type is invalid.',

            'date.required' => 'Please select a date.',
            'date.date' => 'Please enter a valid date.',

            'time.required' => 'Please select a time.',
            'time.date_format' => 'Please select a valid time.',

            'instructor_id.required' => 'Please select an instructor.',
            'instructor_id.exists' => 'The selected instructor is invalid.',
        ];
    }
}
