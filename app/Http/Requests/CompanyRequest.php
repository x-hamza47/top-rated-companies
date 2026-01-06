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
        return $user && ($user->role === "admin" || $user->role === "company");
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
            'min_project_size' => 'required|numeric|min:0|max:250000',
            'hourly_rate_min' => 'required|numeric|min:0|max:500',
            'hourly_rate_max' => 'required|numeric|min:0|max:500|gte:hourly_rate_min',
            'employees_min' => 'required|integer|min:0|max:500',
            'employees_max' => 'required|integer|min:0|max:500|gte:employees_min',
            'founded' => 'required|digits:4|integer|min:1800|max:' . date('Y'),
            'languages' => 'required|array|min:1|max:15',
            'languages.*' => 'required|string|max:50',
            'website' => 'nullable|url',
            'social_links' => 'required|array|min:1|max:4',
            'social_links.facebook' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',

            // ! Services Expertise
            'services' => 'required|array|min:1|max:15',
            'services.*' => 'integer',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $services = $this->input('services', []);

            if (empty($services)) {
                $validator->errors()->add('services', 'At least one service is required.');
            }

            foreach ($services as $id => $percent) {
                if (!\App\Models\Service::where('id', $id)->exists()) {
                    $validator->errors()->add('services', "Selected service with ID {$id} does not exist.");
                }
                if (!is_numeric($percent) || $percent < 0 || $percent > 100) {
                    $validator->errors()->add('services', "Expertise for service ID {$id} must be between 0 and 100.");
                }
            }

            $total = array_sum($services);
            if ($total !== 100) {
                $validator->errors()->add('services', "Total expertise must be exactly 100%");
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
            // Companies table
            'name.required' => 'Company name is required.',
            'name.string' => 'Company name must be a valid string.',
            'name.max' => 'Company name cannot exceed 255 characters.',
            'name.unique' => 'This company name is already taken.',

            'slug.required' => 'Company slug is required.',
            'slug.string' => 'Slug must be a valid string.',
            'slug.max' => 'Slug cannot exceed 255 characters.',
            'slug.unique' => 'This slug is already in use.',

            'tagline.required' => 'Tagline is required.',
            'tagline.string' => 'Tagline must be a valid string.',
            'tagline.max' => 'Tagline cannot exceed 255 characters.',

            'about.required' => 'About section is required.',
            'about.string' => 'About section must be text.',

            // Company details
            'min_project_size.required' => 'Minimum project size is required.',
            'min_project_size.numeric' => 'Minimum project size must be a number.',
            'min_project_size.min' => 'Minimum project size cannot be negative.',
            'min_project_size.max' => 'Minimum project size cannot exceed 250,000.',

            'hourly_rate_min.required' => 'Minimum hourly rate is required.',
            'hourly_rate_min.numeric' => 'Minimum hourly rate must be a number.',
            'hourly_rate_min.min' => 'Minimum hourly rate cannot be negative.',
            'hourly_rate_min.max' => 'Minimum hourly rate cannot exceed 500.',

            'hourly_rate_max.required' => 'Maximum hourly rate is required.',
            'hourly_rate_max.numeric' => 'Maximum hourly rate must be a number.',
            'hourly_rate_max.min' => 'Maximum hourly rate cannot be negative.',
            'hourly_rate_max.max' => 'Maximum hourly rate cannot exceed 500.',
            'hourly_rate_max.gte' => 'Maximum hourly rate must be greater than or equal to minimum hourly rate.',

            'employees_min.required' => 'Minimum employee count is required.',
            'employees_min.integer' => 'Minimum employee count must be a number.',
            'employees_min.min' => 'Minimum employees cannot be negative.',
            'employees_min.max' => 'Minimum employees cannot exceed 500.',

            'employees_max.required' => 'Maximum employee count is required.',
            'employees_max.integer' => 'Maximum employee count must be a number.',
            'employees_max.min' => 'Maximum employees cannot be negative.',
            'employees_max.max' => 'Maximum employees cannot exceed 500.',
            'employees_max.gte' => 'Maximum employees must be greater than or equal to minimum employees.',

            'founded.required' => 'Founded year is required.',
            'founded.digits' => 'Founded year must be 4 digits.',
            'founded.integer' => 'Founded year must be a number.',
            'founded.min' => 'Founded year cannot be before 1800.',
            'founded.max' => 'Founded year cannot be in the future.',

            'languages.required' => 'At least one language is required.',
            'languages.array' => 'Languages must be an array.',
            'languages.min' => 'At least one language is required.',
            'languages.max' => 'You can select a maximum of 15 languages.',
            'languages.*.required' => 'Each language is required.',
            'languages.*.string' => 'Each language must be a valid string.',
            'languages.*.max' => 'Each language cannot exceed 50 characters.',

            'website.url' => 'Website must be a valid URL.',

            'social_links.required' => 'Social links are required.',
            'social_links.array' => 'Social links must be an array.',
            'social_links.min' => 'At least one social link is required.',
            'social_links.max' => 'You can add a maximum of 4 social links.',
            'social_links.facebook.url' => 'Facebook link must be a valid URL.',
            'social_links.instagram.url' => 'Instagram link must be a valid URL.',
            'social_links.linkedin.url' => 'LinkedIn link must be a valid URL.',
            'social_links.twitter.url' => 'Twitter link must be a valid URL.',

            // Services
            'services.required' => 'Please select at least one service.',
            'services.array' => 'Services must be an array.',
            'services.min' => 'Please select at least one service.',
            'services.max' => 'You can select a maximum of 15 services.',
            'services.*.integer' => 'Each service must be a valid number.',
            'services.*.exists' => 'Selected service does not exist.',
        ];
    }
}
