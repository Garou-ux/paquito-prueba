<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
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
            'clave' => 'required|is_process_delete',
            'nombre' => 'required|is_process_delete',
            'precio' => 'required|is_process_delete',
            'costo' => 'required|is_process_delete'
        ];
    }

    public function messages(){
        return[
            'clave.required' => trans('tabla.validate.clave'),
            'nombre.required' => trans('tabla.validate.nombre'),
            'precio.required' => trans('tabla.validate.precio'),
            'costo.required' => trans('tabla.validate.costo'),
        ];
    }
}
