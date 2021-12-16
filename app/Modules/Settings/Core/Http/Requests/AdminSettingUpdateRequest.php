<?php

namespace App\Modules\Settings\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingUpdateRequest extends FormRequest
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
            'percent1'  => 'required|int|between:1,100',
            'percent2'  => 'required|int|between:1,100',
            'percent3'  => 'required|int|between:1,100',
            'percent4'  => 'required|int|between:1,100',
        ];
    }
}
