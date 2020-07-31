<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => ['required', 'min:3'],
            'email'   => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'address' => ['sometimes', 'nullable','min:3'],
            'image'   => ['sometimes','nullable','image','mimes:jpg,jpeg,png,gif,bmp','max:10000',
        ],
        ];
    }
}
