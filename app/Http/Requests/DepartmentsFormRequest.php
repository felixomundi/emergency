<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentsFormRequest extends FormRequest
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
            "status"=> ["required", "integer"],

        ];

        if($this->getMethod() == "POST"){
            $rules += [
                "name" =>["required", "string","unique:departments,name",],
            ];
        }

        if($this->getMethod() == "PUT"){
          $rules += [
          "name" =>  [
                "required",
                "string",
                Rule::unique("departments")->ignore($this->id),  ],

            ];
        }
        return $rules;
    }
}
