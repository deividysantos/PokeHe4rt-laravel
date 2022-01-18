<?php

namespace App\Http\Requests\Auth;

use App\Models\Trainer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisteredUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'region' => ['required', 'string'],
            'age' => ['required', 'numeric']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator)
        {
            if($this->trainerAlreadyExistsByRegionAndName(
                $validator->getData()['region'],
                $validator->getData()['name']))
            {
                $validator->errors()->add('name', 'This trainer name already exisits in this region!');
            }
        });
    }

    public function trainerAlreadyExistsByRegionAndName($region, $name):bool
    {
        $trainer = Trainer::where('name', $name)->get()->first();

        if($trainer)
        {
            return true;
        }

        return false;
    }
}
