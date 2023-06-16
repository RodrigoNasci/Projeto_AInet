<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'notes' => 'nullable|string|max:255',
            'nif' => 'required|digits:9',
            'address' => 'required|string|max:60',
            'payment_type' => 'required|in:VISA,PAYPAL,MC',
            'payment_ref' => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($this->input('payment_type') === 'VISA' || $this->input('payment_type') === 'MC') {
                        if (!preg_match('/^\d{16}$/', $value)) {
                            $fail('Se o pagamento é VISA OU MC a referência de pagamento corresponde ao número do
                            cartão de crédito e deverá ter 16 dígitos.');
                        }
                    } elseif ($this->input('payment_type') === 'PAYPAL') {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $fail('Se o pagamento é PAYPAL a referência de pagamento deverá ser um email válido.');
                        }
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'notes.max' => 'O campo "Notas" não pode ter mais de 255 caracteres.',
            'notes.string' => 'O campo "Notas" deve ser uma string',
            'nif.digits' => 'O campo "NIF" deve ter 9 dígitos.',
            'nif.required' => 'O campo "NIF" é obrigatório',
            'address.max' => 'O campo "Endereço" não pode ter mais de 60 caracteres.',
            "address.required" => 'O campo "Endereço" é obrigatório',
            'address.string' => 'O campo "Endereço" deve ser uma string',
            'payment_type.in' => 'O campo "Tipo de pagamento" deve ser um dos seguintes: VISA, PAYPAL, MC.',
            'payment_ref.max' => 'O campo "Referência de pagamento" não pode ter mais de 255 caracteres.',
        ];
    }
}
