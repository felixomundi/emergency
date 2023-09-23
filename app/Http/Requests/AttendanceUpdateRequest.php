<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceUpdateRequest extends FormRequest
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
        $rules = [
            "course"=>["required", "integer", "exists:courses,id"],
            "unit"=>["required", "integer", "exists:units,id"],
            "user"=>["required", "integer", "exists:users,id"],
            "attendance_date"=>["required", "date"],
            "start_time"=>["required", ],
            "end_time"=>["required", "after:start_time"],
            "content_covered"=>["required", ],
            "next_lesson_content"=>["required",],
        ];
        return $rules;
    }
}
