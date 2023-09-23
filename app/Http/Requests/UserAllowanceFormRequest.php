<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAllowanceFormRequest extends FormRequest
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
            "user"=>"required|integer|exists:users,id",
            "allowance_name"=> "required",
            "amount"=>["required", "numeric", "min:0.00"],
            "status"=>"required|integer",
        ];
        if($this->getMethod() ==="POST"){
            $rules += [
                "effective_date"=> "required|date",
                "closing_date"=> "required|date|after:effective_date",
            ];
        }
        if($this->getMethod() ==="PUT"){
            $rules += [

            ];
        }
        return $rules;
    }
}
