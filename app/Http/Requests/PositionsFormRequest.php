<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class PositionsFormRequest extends FormRequest
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
        "status"=>["required", "integer"],
        "department_id"=>["required", "integer", "exists:departments,id"],
    ];
    if($this->getMethod() =="POST"){
        $rules += [
            "name" =>[
                "required",
                "string",
                "max:255",
                "unique:positions,name,"],
        ];
    }
    if($this->getMethod() == "PUT"){
        $rules += [
            "position_id"=>["required", "integer"],
            'name' => [
                'required', "string", "unique:positions,name,".Request::get('position_id'),
            ],

        ];
    }

    return $rules;
    }
}
