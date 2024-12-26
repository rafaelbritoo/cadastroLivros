<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssuntoRequest extends FormRequest
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
        $assuntoId = $this->route('assunto');
        return [
            'descricao' => [
                'required',
                'min:3',
                'max:20',
                Rule::unique('assunto', 'descricao')->ignore($assuntoId, 'codAs'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => 'Campo é Descrição do assunto é obrigatorio!',
            'descricao.min' => 'O campo descrição deve ter pelo menos 3 caracteres!',
            'descricao.max' => 'O campo descrição deve ter pelo menos 20 caracteres!',
            'descricao.unique' => 'A descrição já existe no banco de dados!',
        ];
    }
}
