<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class SaveUserFormRequest extends FormRequest
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
      $rules =
            [
                'name' => ['required', 'string', 'max:60'],
                'role_as' => ['required','integer'],
                "status"=>["required", "integer"],
                "dob"=>["date","nullable",],
                "father_name"=>["string","max:60","nullable"],
                "father_occupation"=>["string","max:60","nullable"],
                "father_phone_number"=>["string", "max:15", "min:10", "nullable"],
                "mother_name"=>["string","max:60","nullable"],
                "mother_occupation"=>["string","max:60","nullable"],
                "mother_phone_number"=>["string", "max:15", "min:10", "nullable"],
                "county"=>["string","max:60","nullable"],
                "district"=>["string","max:60","nullable"],
                "division"=> ["string","max:60","nullable"],
                "location"=>["string","max:60","nullable"],
                "sub_location"=>["string","max:60","nullable"],
                "gender"=>["required", "string"],
        ];
        if($this->getMethod() =="POST"){
            $rules += [
                "email"=> ["required", "string","max:255", "unique:users"],
                'password' => ['required', 'string', 'min:8',"max:16","confirmed"],
                "phone" =>[
                    "required",
                    "string",
                    "min:10",
                    "max:15",
                    Rule::unique('users')
                       ->where('phone', $this->phone),
                 ],
                 'image' => ['required','image','mimes:jpg,png,jpeg',],
            ];
        }

        if($this->getMethod()=="PUT"){
            $rules += [
                'password' => ['nullable', 'string', 'min:8',"max:16"],
                "email" =>  [
                    "required",
                    "string",
                    "email",
                       Rule::unique('users')->ignore(Request::get('userId')),],
                    "userId"=>["required", "integer"],
                    'phone' => [
                        'required',"unique:users,phone,".Request::get('userId')
                    ],
                    'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg|max:5000',
                    "password" =>["nullable", "string", "min:8","max:16"],
            ];
        }

        return $rules;


    }
}
