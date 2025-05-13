<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can apply authorization logic here if needed.
        // For now, returning true to allow all users.
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'mobile' => 'required|digits:10',
            'course_id' => 'required|exists:courses,id'
        ];
    }

    /**
     * Get the custom error messages for validation failures.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'first_name.string' => 'First name must be a valid string.',
            'first_name.max' => 'First name cannot be more than 255 characters.',
            'last_name.required' => 'Please enter your last name.',
            'last_name.string' => 'Last name must be a valid string.',
            'last_name.max' => 'Last name cannot be more than 255 characters.',
            'email.required' => 'Please provide a valid email address.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already registered.',
            'mobile.required' => 'Please provide a mobile number.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',
            'course_id.required' => 'Please select a course.',
            'course_id.exists' => 'The selected course is invalid.'
        ];
    }
}
