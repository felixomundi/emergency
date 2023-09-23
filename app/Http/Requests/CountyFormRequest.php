<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CountyFormRequest extends FormRequest
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
                "name" => ["required", "string", "unique:counties",],
                
            ];
           }
    
           if($this->getMethod() == "PUT"){
            $rules += [
                "name" => ["required", "string", Rule::unique("counties")->ignore($this->id),  ],
               
            ];
           }
    
    
        return $rules;
    }
}
