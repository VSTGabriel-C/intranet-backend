<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'position' => ['string'],
            'card_id' => ['string', 'required'],
            'cellphone' => ['string'],
            'email' => ['string'],
            'photo' => ['file'],
            'fk_section' => ['integer'],
            'fk_parent' => ['integer'],
        ];
    }
}
