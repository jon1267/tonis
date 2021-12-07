<?php

namespace App\Modules\Sellers\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSellerStoreRequest extends FormRequest
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
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|between:5,25|confirmed',
            'phone' => 'required|max:100',
            'point_id' => 'required',
            //'photo' => 'required|max:255', ?
            //'role' => 'required|max:255', //роль делает mysql по дефолту = 'seller'
        ];
    }
}
