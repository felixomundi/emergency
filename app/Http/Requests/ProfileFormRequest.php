<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
        return [
            "identity_number" =>[
                "required",
                "string",
                "min:7",
                "max:8",
                Rule::unique('users')->ignore(\Request::get('userId')),
             ],
             "county"=>"required",
             "sub_county"=>"required",
             "district"=>"required",
             "division"=>"required",
             "location"=>"required",
             "sub_location"=>"required",
        ];
    }
}
