<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssuntoFilterRequest extends FormRequest
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
            'descricao' => 'nullable|string|max:20', // Filtros não são obrigatórios
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.max' => 'O campo descrição deve ter no máximo 20 caracteres!',
        ];
    }
}
