<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'course_name'        => 'required|max:255',
            'course_description' => 'required|max:1000',
            'course_fees'        => 'required|digits_between:1,5|min:0',
            'thumbnail'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ];

        // If course_id is not present => Create mode => everything required
        if (!$this->filled('course_id')) {
            $rules['thumbnail']          = 'required|' . $rules['thumbnail'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'course_name.required'        => 'Course name is required.',
            'course_name.max'             => 'Course name cannot be more than 255 characters.',
            'course_description.required' => 'Course description is required.',
            'course_description.max'      => 'Course description cannot be more than 1000 characters.',
            'course_fees.required'        => 'Course fees is required.',
            'course_fees.numeric'         => 'Fees must be a number.',
            'course_fees.digits_between'  => 'Fees must be up to 5 digits only.',
            'course_fees.min'             => 'Fees cannot be negative.',
            'thumbnail.required'          => 'Thumbnail image is required.',
            'thumbnail.image'             => 'The file must be an image.',
            'thumbnail.mimes'             => 'Only JPEG, PNG, JPG, and GIF images are allowed.',
            'thumbnail.max'               => 'The image size must not exceed 5MB.',
        ];
    }
}
