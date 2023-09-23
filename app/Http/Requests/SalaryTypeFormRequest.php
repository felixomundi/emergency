<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class SalaryTypeFormRequest extends FormRequest
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
        $rules = [];
        if($this->getMethod() =="POST"){
            $rules += [
                "title" =>[
                    "required",
                    "string",
                    "max:255",
                    "unique:salary_types,title,"],
            ];
        }
        if($this->getMethod() == "PUT"){
            $rules += [
                "salary_id"=>["required", "integer"],
                'title' => [
                    'required', "string", "max:255", "unique:salary_types,title,".Request::get('salary_id'),

                ],

            ];
        }
         return $rules;
    }
}
