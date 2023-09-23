<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class StaffUpdateFormRequest extends FormRequest
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
            // "date_joined"=>["required", "date"],
            // "name"=>["required", "string","max:60"],
            // "gender" =>["required",  "string", ],
            // "experience"=>["required", "string", "max:500"],
            // "qualification"=>["required", "string", "max:500"],
            // "dob"=> ["required", "date" ],
            // "father_name"=>["required","string", "max:60"],
            // "father_occupation"=>["required","string", "max:60"],
            // "father_phone_number"=>["required","string", "max:15", "min:10"],
            // "mother_name"=>["required","string","max:60"],
            // "mother_occupation"=>["required","string","max:60"],
            // "mother_phone_number"=>["required","string", "max:15", "min:10"],
            // "county"=>["required","string","max:60"],
            // "district"=>["required","string","max:60"],
            // "division"=> ["required","string","max:60"],
            // "location"=>["required","string","max:60"],
            // "sub_location"=>["required","string","max:60"],
            // "staffId"=>["required", "integer"],
            "userId"=>["required","integer"],
            // "email" =>  [
            //     "required",
            //     "email",
            //     Rule::unique('users')->ignore(Request::get('userId')),],
            // 'phone' => [
            //     'required',"unique:staff,phone,".Request::get('staffId')
            // ],
            'image' => ['nullable','sometimes','image','mimes:jpeg,png,jpg']

        ];
        return $rules;
    }
}
