<div class="step-1 px-6 py-4 bg-(--color-background) rounded-b-2xl">
    <h2 class="sm:text-3xl text-2xl font-semibold">Company Info</h2>
    <div class="grid sm:grid-cols-2 gap-4 my-5">

        <x-forms.input-field name="name" label="Company Name" icon="user" placeholder="Acme Inc." :value="$company->name ?? ''" />
        <x-forms.input-field name="tagline" label="Tagline" icon="comment-dots" placeholder="We build great products"
            :value="$company->tagline ?? ''" />
        <x-forms.input-field name="slug" label="Slug" icon="link" placeholder="company-slug" :value="$company->slug ?? ''"
            :muted="true" :readonly="true" />
        <x-forms.year-picker name="founded" label="Founded Year" :value="$company->details?->founded ?? ''" />

    </div>

    {{-- About --}}
    <x-forms.input-field name="about" label="About" type="textarea">
        <textarea name="about" class="summernote w-full">{{ old('about', $company->about ?? '') }}</textarea>
    </x-forms.input-field>

</div>
