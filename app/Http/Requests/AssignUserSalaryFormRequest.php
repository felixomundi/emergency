<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignUserSalaryFormRequest extends FormRequest
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

        ];

        if($this->getMethod() === "POST"){
            $rules += [
            "user_id"=>"required|integer|exists:users,id",
            "areas_of_work_id"=>"required|integer|exists:areas_of_works,id",
            "position_id"=>"required|integer|exists:positions,id",
            "salary_type_id"=>"required|integer|exists:salary_types,id",
             "total"=>["required", "numeric", "min:0.00"],
            ];

        }
        if($this->getMethod() === "PUT"){
            $rules += [
            "user_id"=>"required|integer|exists:users,id",
            "areas_of_work_id"=>"required|integer|exists:areas_of_works,id",
            "position_id"=>"required|integer|exists:positions,id",
            "salary_type_id"=>"required|integer|exists:salary_types,id",
             "total"=>["required", "numeric", "min:0.00"],
            ];
        }

        return $rules;
    }
}
