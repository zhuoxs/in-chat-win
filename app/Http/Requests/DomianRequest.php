<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomianRequest extends FormRequest
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
        $rules = [
        ];

        switch (request()->method()) {
            case "POST":
                $rules = [
                    'open'        => 'required',
                    'domain'      => 'required|domain_not_exists',
                    'setting_id'  => 'required|message_setting',
                    'description' => 'string',
                ];
                break;
        }

        return $rules;
    }
}
