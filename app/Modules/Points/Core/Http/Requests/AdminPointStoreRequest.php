<?php

namespace App\Modules\Points\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPointStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:100',
            //'hash' => 'required|string|max:10',

        ];
    }
}
