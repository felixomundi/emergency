<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class StudentProfileFormRequest extends FormRequest
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
            // "name"=>["required", "string","max:60"],
            // "gender" =>["required",  "string", ],
            // "dob"=>["required","date",],
            // "father_name"=>["required","string","max:60"],
            // "father_occupation"=>["required","string","max:60"],
            // "father_phone_number"=>["required","string", "max:15", "min:10",],
            // "mother_name"=>["required","string","max:60"],
            // "mother_occupation"=>["required","string","max:60"],
            // "mother_phone_number"=>["required","string", "max:15", "min:10",],
            // "county"=>["required","string","max:60"],
            // "district"=>["required","string","max:60"],
            // "division"=> ["required","string","max:60"],
            // "location"=>["required","string","max:60"],
            // "sub_location"=>["required","string","max:60"],
        ];
        if($this->getMethod() == "PUT"){
            $rules += [
                // "studentId"=>["required", "integer"],
                "userId"=>["required", "integer"],

                // 'phone' => [
                //     'required',"unique:students,phone, ".Request::get('studentId')
                // ],

                'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg',

            ];
        }

        return $rules;
    }
    // public function messages()
    // {
    //     return [
    //         "name.required"=>"Student Name is required",
    //         "name.max"=>"Name should be upto 60 characters",
    //         "phone.required"=>"Student Phone is required",
    //         "phone.unique"=>"The phone number is already taken",
    //         "phone.max"=>"Phone should be upto 15 characters",
    //         "gender.required"=>"Student Gender is required",
    //         "image.required"=>"Student Photo is required",

    //     ];
    // }



}
