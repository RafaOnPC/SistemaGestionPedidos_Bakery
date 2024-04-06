<?php

namespace App\Http\Requests\Pedidos;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dir_envio' => 'required|regex:/^[a-zA-Z]+$/',
            'estado_ped' => 'required|in:E,P,F',
            'date_ped' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array'
        ];
    }

    public function attributes()
    {
        return [
            'dir_envio' => 'Direccion de Envio',
            'estado_ped' => 'Estado del pedido',
            'date_ped' => 'Fecha del pedido',
        ];
    }

    public function messages()
    {
        return [
            'dir_envio.required' => 'Debe ser una cadena de texto',
        ];
    }
}
