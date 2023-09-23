<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignCourseFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user" =>["required", "integer","exists:users,id"],
            'course' => 'required|integer|exists:courses,id',
        ];
    }
    public function messages(){
        return [
            "user.required" => "Staff is required",
            "course.required" => "Course is required",
        ];
    }
}
