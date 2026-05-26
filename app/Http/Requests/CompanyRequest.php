<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
{    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && in_array($user->role, ['admin', 'dev', 'company']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route("id");

        return [
            // ! Companies table
            'name' => 'required|string|max:255|unique:companies,name,' . $id,
            'slug' => 'required|string|max:255|unique:companies,slug,' . $id,
            'tagline' => 'required|string|max:255',
            'about' => 'required|string',

            // ! Company details table
            'min_project_size' => 'required|in:' . implode(',', array_keys(config('company.project_sizes'))),
            'hourly_rate' => 'required|in:' . implode(',', array_keys(config('company.hourly_rates'))),
            'employees_range' => 'nullable|required_without:is_freelancer|in:' . implode(',', config('company.employee_ranges')) . '|prohibited_if:is_freelancer,1',
            'is_freelancer' => 'nullable|boolean|required_without:employees_range',
            'founded' => 'required|digits:4|integer|min:1800|max:' . date('Y'),
            'languages' => 'required|array|min:1|max:15',
            'languages.*' => 'required|string|max:50',
            'website' => 'nullable|url',
            'social_links' => 'required|array',
            'social_links.facebook' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',

            // ! Services
            'services' => 'required|array|min:1|max:15',
            'services.*.expertise_percentage' => 'nullable|integer|min:0|max:100',
            'services.*.description' => 'nullable|string|max:1000',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $social = array_filter($this->input('social_links', []));
            if (empty($social)) {
                $validator->errors()->add('social_links', 'At least one social link is required.');
            }
            $services = $this->input('services', []);

            if (empty($services)) {
                $validator->errors()->add('services', 'At least one service is required.');
                return;
            }

            $total = 0;
            foreach ($services as $id => $data) {
                if (!\App\Models\Service::where('id', $id)->exists()) {
                    $validator->errors()->add('services', "Selected service with ID {$id} does not exist.");
                }

                $percent = is_array($data) ? ($data['expertise_percentage'] ?? 0) : $data;

                if (!is_numeric($percent) || $percent < 0 || $percent > 100) {
                    $validator->errors()->add('services', "Expertise for service ID {$id} must be between 0 and 100.");
                }

                $total += (int) $percent;
            }

            if ($total !== 100) {
                $validator->errors()->add('services', "Total expertise must be exactly 100%.");
            }
        });
    }

    protected function prepareForValidation()
    {
        //! Fix Tagify languages (json -> array)
        $languagesInput = $this->input('languages');

        $languages = [];

        if (is_string($languagesInput)) {
            $decoded = json_decode($languagesInput, true, 512, JSON_OBJECT_AS_ARRAY);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $languages = $decoded;
            }
        } elseif (is_array($languagesInput)) {
            $languages = $languagesInput;
        }

        $languages = array_filter($languages, function ($item) {
            return !empty($item['value'] ?? '');
        });

        $languages = array_values($languages);

        $social = $this->social_links ?? [];
        $social = array_filter($social, fn($value) => !empty($value));
        $this->merge([
            'languages' => array_values(array_map(fn($item) => $item['value'], $languages)),
            'social_links' => $social,
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'name.max' => 'Company name cannot exceed 255 characters.',
            'name.unique' => 'This company name is already taken.',

            'slug.required' => 'Company slug is required.',
            'slug.max' => 'Slug cannot exceed 255 characters.',
            'slug.unique' => 'This slug is already in use.',

            'tagline.required' => 'Tagline is required.',
            'tagline.max' => 'Tagline cannot exceed 255 characters.',

            'about.required' => 'About section is required.',

            'min_project_size.required' => 'Minimum project size is required.',
            'min_project_size.in' => 'Please select a valid project size.',

            'hourly_rate.required' => 'Hourly rate range is required.',
            'hourly_rate.in' => 'Please select a valid hourly rate range.',

            'employees_range.required_without' => 'Please select an employee range or mark yourself as a freelancer.',
            'employees_range.in' => 'Please select a valid employee range.',
            'employees_range.prohibited_if' => 'You cannot select an employee range if you are a freelancer.',
            'is_freelancer.required_without' => 'Please select an employee range or mark yourself as a freelancer.',
            'is_freelancer.boolean' => 'Freelancer field must be true or false.',

            'founded.required' => 'Founded year is required.',
            'founded.digits' => 'Founded year must be 4 digits.',
            'founded.min' => 'Founded year cannot be before 1800.',
            'founded.max' => 'Founded year cannot be in the future.',

            'languages.required' => 'At least one language is required.',
            'languages.min' => 'At least one language is required.',
            'languages.max' => 'You can select a maximum of 15 languages.',
            'languages.*.string' => 'Each language must be a valid string.',
            'languages.*.max' => 'Each language cannot exceed 50 characters.',

            'website.url' => 'Website must be a valid URL.',

            'social_links.required' => 'At least one social link is required.',
            'social_links.facebook.url' => 'Facebook link must be a valid URL.',
            'social_links.instagram.url' => 'Instagram link must be a valid URL.',
            'social_links.linkedin.url' => 'LinkedIn link must be a valid URL.',
            'social_links.twitter.url' => 'Twitter link must be a valid URL.',

            'services.required' => 'Please select at least one service.',
            'services.min' => 'Please select at least one service.',
            'services.max' => 'You can select a maximum of 15 services.',
        ];
    }
}
