<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'document_type' => 'required|exists:document_types,name',
            'document' => 'required|numeric|digits_between:1,12',
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'email' => 'required|email|max:80',
            'street'=>'required',
            'country'=>'required'
        ];
    }
    /* public function attributes()
    {
        return [
            'person_type' => 'Tipo De Persona',
            'document_type' => 'Tipo De Documento',
            'document' => 'Documento',
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'email' => 'Correo Electrónico',
            'city' => 'Ciudad',
            'province' => 'Departamento/Provincia',
        ];
    } */
}
