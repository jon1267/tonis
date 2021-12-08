<?php

namespace App\Modules\Promocodes\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPromocodeUpdateRequest extends FormRequest
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
            'code' => 'required|string|max:100',
            'percent' => 'required|int',
            'phone' => 'required|string|max:100',
            //'hash' => 'required|string|max:10',
        ];
    }
}
