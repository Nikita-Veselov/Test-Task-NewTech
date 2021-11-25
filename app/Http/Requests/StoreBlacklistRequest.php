<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlacklistRequest extends FormRequest
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
            'blacklist' => array('required', 'regex:/^"(\s*p[0-9]+,\ss[0-9]+,*)*"$/'),
            'adv_id' => array('exists:advertisers','required'),
        ];
    }
}
