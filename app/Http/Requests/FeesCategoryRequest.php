<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class FeesCategoryRequest extends FormRequest
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

        if($this->getMethod() == "POST"){
            $rules += [
                "name" =>["required", "string", "unique:fee_categories,name",],
            ];
        }

        if($this->getMethod() == "PUT"){

        $rules += [
        "name" =>  [
        "required",
        "string",
        Rule::unique("fee_categories")->ignore(Request::get("fee_category")),
         ],
        "fee_category" =>["required","integer",],

            ];
        }
        
        return $rules;
    }
}
