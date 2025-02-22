<?php

namespace Modules\Informat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreInstituteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'institute_code' => ['required', 'string', 'max:255'],
            'institute_name' => ['required', 'string', 'max:255'],
            'institute_address' => ['nullable', 'string', 'max:255'],
            'institute_area' => ['nullable', 'string', 'max:255'],
            'institute_city' => ['nullable', 'string', 'max:1000'],
            'institute_country' => ['nullable', 'string', 'max:1000']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create_institutes');
    }
}
