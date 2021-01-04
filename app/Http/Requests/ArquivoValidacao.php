<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArquivoValidacao extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'arquivo' => 'required|file|min:0.0001|mimes:jpeg,jpg,png,gif,wmv,mp4,wav,mpga,bin,pptx,doc,docx,xlsx,txt,pdf,xml,zip,rar|max:2000',
        ];
    }

    /**
     * Define uma mensagem de erro para a o campo e cada uma das regras de validação
     *
     * @return array
     */
    public function messages()
    {
        return [
            'arquivo.required' => 'Nenhum arquivo foi enviado!',
            'arquivo.file' => 'Não é um arquivo!',
            'arquivo.mimes' => 'O arquivo não está em um formato válido! Formatos válidos: :values.',
            'arquivo.min' => 'O arquivo não pode estar vazio!',
            'arquivo.max' => 'O arquivo não pode ser maior que 2MB!',
            'arquivo.uploaded' => '***',
        ];
    }
}
