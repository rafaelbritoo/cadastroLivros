<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorFilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'nullable|string|max:40', // Filtros não são obrigatórios
        ];
    }

    public function messages(): array
    {
        return [
            'nome.max' => 'O campo descrição deve tter no máximo 40 caracteres!',
        ];
    }
}
