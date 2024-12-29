<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RelatorioRequest extends FormRequest
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
            'titulo' => 'nullable|string|max:40',
            'autor' => 'nullable|string|max:40',
            'assunto' => 'nullable|string|max:20',
//            'valor_min' => 'nullable|numeric|min:0',
//            'valor_max' => 'nullable|numeric|min:0|gte:valor_min',
            'sort_by' => 'nullable|in:livro_titulo,autor_nome,valor_formatado',
            'sort_direction' => 'nullable|in:asc,desc',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.max' => 'O campo Título não pode ter mais de 40 caracteres!',
            'editora.max' => 'O campo Autor não pode ter mais de 40 caracteres!',
            'titulo.string' => 'O título deve ser uma string.',
            'autor.string' => 'O autor deve ser uma string.',
            'assunto.string' => 'O assunto deve ser uma string.',
            'sort_by.in' => 'A ordenação é inválida.',
            'sort_direction.in' => 'A direção de ordenação é inválida.',
            'valor_min.min' => 'O campo valor minímo deve ser maior que 0!',
            'valor_max.gte' => 'O campo valor máximo deve ser maior que o valor minímo!',
        ];
    }
}
