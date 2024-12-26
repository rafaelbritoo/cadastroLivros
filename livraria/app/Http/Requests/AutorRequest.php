<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AutorRequest extends FormRequest
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
        $autorId = $this->route('autor');
        return [
            'nome' => [
                'required',
                'min:3',
                'max:40',
                Rule::unique('autor', 'nome')->ignore($autorId, 'codAu'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Campo é Nome do autor é obrigatorio!',
            'nome.min' => 'O campo nome deve ter pelo menos 3 caracteres!',
            'nome.max' => 'O campo nome deve ter pelo menos 40 caracteres!',
            'nome.unique' => 'O campo nome já existe no banco de dados!',
        ];
    }
}
