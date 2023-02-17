<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
        return [
            'name' => 'required|max:100|min:2',
            'is_available' => 'required',
            'price' => 'required|max:999.99|min:0.01',
            'description' => 'required|max:255|min:10',
            'img_url' => 'image|max:3200',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.max' => 'Il nome deve avere massimo :max caratteri',
            'name.min' => 'Il nome deve avere minimo :min caratteri',

            'is_available.required' => 'La disponibilità è un campo obbligatorio',

            'price.required' => 'Il prezzo è un campo obbligatorio',
            'price.max' => 'Il prezzo deve essere inferiore a &euro;999,99',
            'price.min' => 'Il prezzo deve essere maggiore di &euro;0',

            'description.required' => 'La descrizione è un campo obbligatorio',
            'description.max' => 'La descrizione deve avere massimo :max caratteri',
            'description.min' => 'La descrizione deve avere minimo :min caratteri',


            'img_url.image' => 'Il file immagine non è corretto',
            'img_url.max' => 'Il file immagine deve essere al massimo di :max MB'
        ];
    }
}
