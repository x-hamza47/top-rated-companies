<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFilterRequest extends FormRequest
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
            'location' => 'nullable|string',
            'budget' => ['nullable', 'in:' . implode(',', array_keys(config('company.project_sizes')))],
            'hourly' => ['nullable', 'in:' . implode(',', array_keys(config('company.hourly_rates')))],
            'industries' => 'nullable|array',
            'services' => 'nullable|array',
        ];
    }
}
