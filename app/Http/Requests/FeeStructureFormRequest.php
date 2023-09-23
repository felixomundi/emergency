<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeStructureFormRequest extends FormRequest
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
        if($this->getMethod() == "POST"){
            $rules += [
                "course" =>["required", "integer","exists:courses,id"],
                "fee_category" =>["required", "integer","exists:fee_categories,id"],
                "amount"=>["nullable", "numeric", "min:0.00", "max:10000000000.99"],
            ];
        }

        if($this->getMethod() == "PUT"){
            $rules += [
                
            ];
        }
        return $rules;
    }
}
