<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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

            'name' => 'required|max:200|min:2',
            'VAT' => 'required|max:11|min:11',
            'address' => 'required|max:150|min:8',
            'img_url' => 'nullable|image|max:64000'
        ];
    }
    public function message()
    {
        return [

            'name.required' => 'Inserisci un nome valido',
            'name.max' => 'Inserisci un nome valido di massimo 200 caratteri',
            'name.min' => 'Inserisci un nome valido di minimo 2 caratteri',
            'VAT.required' => 'Inserire la P.IVA',
            'VAT.max' => 'Inserire la P.IVA (11 caratteri)',
            'VAT.min' => 'Inserire la P.IVA (11 caratteri)',
            'address.required' => 'Inserisci l\'ubicazione del tuo ristorante',
            'address.max' => 'Inserisci un massimo di 150 caratteri',
            'address.min' => 'Inserisci un minimo di 8 caratteri',
            'img_url.image' => 'Inserisci un file immagine',
            'img_url.max' => 'Immagine troppo grande'

        ];
    }
}
