<?php

namespace Modules\Informat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateInformatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'insumo_name' => ['required', 'string', 'max:255'],
            'insumo_code' => ['required', 'string', 'max:255'],
            'insumo_type' => ['required', 'string', 'max:255'],
            'insumo_status' => ['required', 'string', 'max:255'],
            'insumo_temp' => ['required', 'string', 'max:255'],
            'insumo_lot' => ['required', 'string', 'min:1'],
            'insumo_unit' => ['nullable', 'string', 'max:1000'],
            'insumo_quantity' => ['nullable', 'string', 'max:1000'],
            'insumo_note' => ['nullable', 'string', 'max:1000']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_Informats');
    }
}
