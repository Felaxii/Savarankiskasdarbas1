<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust according to your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today', // Ensure the date is today or in the future
            'time' => 'required|date_format:H:i', // Validate time format (24-hour format)
            'address' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom error messages for the validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'date.required' => 'The date field is required.',
            'date.after_or_equal' => 'The date must be today or in the future.',
            'time.required' => 'The time field is required.',
            'address.required' => 'The address field is required.',
        ];
    }
}
