<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class GradeFormRequest extends FormRequest
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
        $rules =[

            "grade_point" =>["required","string"],
            "start_marks" =>["required","string"],
            "end_marks" =>["required","string"],
            "start_point" =>["required","string"],
            "end_point" =>["required","string"],
            "remarks" =>["required","string"],
        ];

        if($this->getMethod() == "POST"){
            $rules += [
                "grade_name" =>["required","string","unique:grade_points,grade_name,"],
            ];
        }
        if($this->getMethod() == "PUT"){
            $rules += [
                "grade_name" =>
                [
                "required",
                "string",
                Rule::unique("grade_points")->ignore($this->id),
            ],
            ];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            "grade_name.unique"=> "The " .Request::get("grade_name")." grade exists",
        ];
    }
}
