<?php

namespace App\Modules\Promocodes\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiPromocodeCreateRequest extends FormRequest
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
            'phone' => 'required|string|max:100',
            'answers' => 'required|array|min:1',
            'point_id' => 'required|exists:points,id',
            //'percent' => 'required|int',
            //'code' => 'required|string|max:100',
        ];
    }
}
