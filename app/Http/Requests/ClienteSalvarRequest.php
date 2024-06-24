<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;

class ClienteSalvarRequest extends FormRequest
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
        $tipo_pessoa = json_decode($this->getContent())->tipo_pessoa;

        if($tipo_pessoa == Cliente::TIPO_PESSOA_FISICA) {
            $rules = [
                'nome_completo' => ['required'],
                'cpf_cnpj' => ['required'],
                'cep' => ['required'],
                'endereco' => ['required'],
                'numero' => ['required'],
                'bairro' => ['required'],
                'cidade' => ['required'],
                'uf' => ['required'],
                'email' => ['required'],
                'telefone' => ['required'],
            ];
        } elseif($tipo_pessoa == Cliente::TIPO_PESSOA_JURIDICA) {
            $rules = [
                'razao_social' => ['required'],
                'cpf_cnpj' => ['required'],
                'substituto_tributario' => ['required'],
                'ie' => ['required'],
                'cep' => ['required'],
                'endereco' => ['required'],
                'numero' => ['required'],
                'bairro' => ['required'],
                'cidade' => ['required'],
                'uf' => ['required'],
                'email' => ['required'],
                'telefone' => ['required'],
            ];
        } elseif($tipo_pessoa == Cliente::TIPO_ESTRANGEIRO) {
            $rules = [
                'nome_completo' => ['required'],
                'uf' => ['required'],
                'endereco' => ['required'],
                'numero' => ['required'],
                'bairro' => ['required'],
            ];
        } else {
            return false;
        }

        return $rules;
    }

    public function messages()
    {
        return [     
            'required' => 'O campo é obrigatório'
        ]; 
    }
}
