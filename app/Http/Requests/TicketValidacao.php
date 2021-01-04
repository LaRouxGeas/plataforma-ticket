<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketValidacao extends FormRequest
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
            'enviar' => 'required',
            'tic_titulo' => 'required_if:enviar,==,Enviar ticket|max:120',
            'tic_validade' => 'required_if:enviar,==,Enviar ticket|date_format:d/m/Y|after:yesterday',
            'tic_descricao' => 'required_if:enviar,==,Enviar ticket',
            'comunicacoes' => 'required_if:enviar,==,Enviar ticket|array',
            'empresas' => 'required_if:enviar,==,Enviar ticket|array',
            'regioes' => 'required_if:enviar,==,Enviar ticket|array',
            'produtos' => 'required_if:enviar,==,Enviar ticket|array',
            'publicosAlvos' => 'required_if:enviar,==,Enviar ticket|array',
            'fk_aprovador' => 'required_if:enviar,==,Enviar ticket|integer',
            'tic_obs_solicitante' => 'nullable',
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
            'enviar.required' => '*',
            'tic_titulo.required_if' => 'O Título é um campo obrigatório!',
            'tic_titulo.max' => 'O Título não pode ser maior que :max caracteres!',
            'tic_validade.required_if' => 'O Prazo é um campo obrigatório!',
            'tic_validade.date_format' => 'O Prazo deve ser uma data válida e estar no formato dd/mm/yyyy!',
            'tic_validade.after' => 'O Prazo deve ser uma data futura!',
            'tic_descricao.required_if' => 'A Descrição é um campo obrigatório!',
            'comunicacoes.required_if' => 'Preencher pelo menos uma das alternativas do campo Meio de Comunicação!',
            'empresas.required_if' => 'Preencher pelo menos uma das alternativas do campo Empresa!',
            'regioes.required_if' => 'Preencher pelo menos uma das alternativas do campo Região!',
            'produtos.required_if' => 'Preencher pelo menos uma das alternativas do campo Produto!',
            'publicosAlvos.required_if' => 'Preencher pelo menos uma das alternativas do campo Público Alvo!',
            'fk_aprovador.required_if' => 'Selecione um dos aprovadores!',
            'fk_aprovador.integer' => 'Valor inválido para o aprovador.',
        ];
    }
}
