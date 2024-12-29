<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroFilterRequest extends FormRequest
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
            'editora' => 'nullable|string|max:40',
            'edicao' => 'nullable|integer',
            'anoPublicacao' => 'nullable|string|max:4',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.max' => 'O campo título deve ter no máximo  40 caracteres!',
            'editora.max' => 'O campo editora deve ter no máximo 40 caracteres!',
            'edicao.integer' => 'O campo edição deve ser um numero inteiro!',
            'anoPublicacao.integer' => 'O campo Ano de publicação deve ser um ano válido!',
        ];
    }
}
