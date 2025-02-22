<?php

namespace Modules\Machine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMachineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'DescActivo' => ['required', 'string', 'max:255'],
            'IDActivo' => ['required', 'string', 'max:255', 'unique:machine,IDActivo'],
            'machine_barcode_symbology' => ['required', 'string', 'max:255'],
            'DescMarca' => ['required', 'string', 'max:255'],
            'DescModelo' => ['required', 'string', 'min:1'],
            'machine_note' => ['nullable', 'string', 'max:1000'],
            'DescCliente' => ['required', 'string', 'max:1000'],
            'date_manufacture' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_macnines');
    }
}
