<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LivroRequest extends FormRequest
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
        // Obtém o ID do livro da URL, se existir
        $livroId = $this->route('livro');

        return [
            'titulo' => [
                'required',
                'min:3',
                'max:40',
                Rule::unique('Livro', 'titulo')->ignore($livroId, 'codl')
            ],
            'editora' => [
                'required',
                'min:3',
                'max:40',
            ],
            'edicao' => [
                'required',
                'integer',
            ],
            'anoPublicacao' => [
                'required',
                'digits:4',
                'integer',
                'min:1500',
                'max:'. date('Y'),
            ],
            'valor' => [
                'required'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo Título é obrigatório!',
            'titulo.min' => 'O campo Título deve ter pelo menos 3 caracteres!',
            'titulo.max' => 'O campo Título não pode ter mais de 40 caracteres!',
            'titulo.unique' => 'O Título já existe no banco de dados!',
            'editora.required' => 'O campo Editora é obrigatório!',
            'editora.min' => 'O campo Editora deve ter pelo menos 3 caracteres!',
            'editora.max' => 'O campo Editora não pode ter mais de 40 caracteres!',
            'edicao.required' => 'O campo Edição é obrigatório!',
            'edicao.integer' => 'O campo Edição deve ser um número inteiro!',
            'anoPublicacao.required' => 'O ano de publicação é obrigatório!',
            'anoPublicacao.digits' => 'O ano deve conter exatamente 4 dígitos!',
            'anoPublicacao.min' => 'O ano deve ser maior que 1500!',
            'anoPublicacao.max' => 'O ano não pode ser maior que o atual!',
            'valor.required' => 'O campo Valor é obrigatório!',
        ];
    }
}
