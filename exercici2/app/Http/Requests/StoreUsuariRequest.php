<?php
// ARXIU PER VALIDAR QUE LA INFORMACIÓ DONADA A LES VARIABLES D'ENTRADA
//  SIGUI CORRECTA 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuariRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:usuaris,email',
            'edat' => 'required|integer|min:0',
        ];
    }
}
