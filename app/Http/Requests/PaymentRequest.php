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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // console.log(err.response.data.errors);
        return [

            'name' => 'required|max:100|min:2',
            'surname' => 'required|max:100|min:2',
            'note' => 'max:255',
            'address' => 'required|max:255|min:5',
            'email' => 'required|max:255|min:5',
            'phoneNumber' => 'required|max:255|min:5',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.max' => 'Il nome deve avere massimo :max caratteri',
            'name.min' => 'Il nome deve avere minimo :min caratteri',

            'surname.required' => 'Il nome è un campo obbligatorio',
            'surname.max' => 'Il nome deve avere massimo :max caratteri',
            'surname.min' => 'Il nome deve avere minimo :min caratteri',

            'email.required' => 'L\'email è un campo obbligatorio',
            'email.max' => 'L\'email deve avere massimo :max caratteri',
            'email.min' => 'L\'email deve avere minimo :min caratteri',

            'phoneNumber.required' => 'Il numero di telefono è un campo obbligatorio',
            'phoneNumber.max' => 'Il nunero di telefono deve avere massimo :max caratteri',
            'phoneNumber.min' => 'Il numero di telefono deve avere minimo :min caratteri',

            'note.max' => 'Le note devo avere massimo :max caratteri',

            'address.required' => 'Il nome è un campo obbligatorio',
            'address.max' => 'L\'indirizzo deve avere massimo :max caratteri',
            'address.min' => 'L\'indirizzo deve avere minimo :min caratteri',

        ];
    }
}
