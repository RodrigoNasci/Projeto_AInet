<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCustomerRequest extends FormRequest
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
            'id'=>'required|exists:users,id',
            'nif'=>'nullable|string|max:9',
            'address'=>'nullable|string|max:60',
            'default_payment_type'=>'nullable|in:VISA,PAYPAL,MC',
            'default_payment_reference'=>'nullable|string|max:255',
        ];
    }
}
