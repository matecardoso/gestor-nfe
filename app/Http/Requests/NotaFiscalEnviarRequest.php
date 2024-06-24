<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;

class NotaFiscalEnviarRequest extends FormRequest
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
        $content = json_decode($this->getContent());

        if($content->operacao->finalidade == 1 || $content->operacao->finalidade == 4) {
            return $this->normal($content);
        } elseif($content->operacao->finalidade == 2) {
            return $this->complementar($content);
        } elseif($content->operacao->finalidade == 3) {
            return $this->ajuste($content);
        } elseif($content->operacao->finalidade == 5) {
            return $this->cartaCorrecao($content);
        } elseif($content->operacao->finalidade == 6) {
            return $this->inutilizarNumeracao($content);
        } else {
            return false;
        };
        
    }

    public function messages()
    {
        return [     
            'required' => 'O campo é obrigatório'
        ]; 
    }

    private function normal($content) 
    {
        /**
         * Operação
         */
        $rules = [
            'operacao.operacao' => ['required'],
            'operacao.natureza_operacao' => ['required'],
            'operacao.modelo' => ['required'],
            'operacao.finalidade' => ['required'],
            'operacao.ambiente' => ['required']
        ];

        /**
         * Cliente
         */
        $cliente = $this->cliente($content);

        /**
         * Produtos
         */
        $produtos = $this->produtos($content);

        /**
         * Pedido
         */
        $pedido = [
            'pedido.presenca' => ['required'],
            'pedido.modalidade_frete' => ['required'],
            'pedido.frete' => ['required'],

            // Pagamento
            'pedido.pagamento.*.pagamento' => ['required'],
            'pedido.pagamento.*.forma_pagamento' => ['required'],
        ];

        if(isset($content->pedido->fatura) && !empty((array) $content->pedido->fatura)) {
            /**
             * Fatura
             */
            $rules = array_merge($rules, [
                'pedido.fatura.numero' => ['required'],
                'pedido.fatura.valor' => ['required'],
                'pedido.fatura.desconto' => ['required'],
                'pedido.fatura.valor_liquido' => ['required'],
            ]);
        };

        if(isset($content->pedido->parcelas) && !empty((array) head($content->pedido->parcelas))) {
            /**
             * Parcelas
             */
            $rules = array_merge($rules, [
                'pedido.parcelas.*.vencimento' => ['required'],
                'pedido.parcelas.*.valor' => ['required'],
            ]);
        };

        if(data_get($content, 'operacao.operacao') == 'importacao') {
            $rules = array_merge($rules, [
                'pedido.despesas_aduaneiras' => ['required']
            ]);
        };

        $rules = array_merge($rules, $cliente);
        $rules = array_merge($rules, $produtos);
        $rules = array_merge($rules, $pedido);

        return $rules;
    }

    private function complementar($content) 
    {
         /**
         * Operação
         */
        $rules = [
            'operacao.operacao' => ['required'],
            'operacao.natureza_operacao' => ['required'],
            'operacao.modelo' => ['required'],
            'operacao.finalidade' => ['required'],
            'operacao.ambiente' => ['required']
        ];

        /**
         * Cliente
         */
        $rules = array_merge($rules, $this->cliente($content));

        if($content->operacao->nfe_complementar == 'preco_quantidade') {

            /**
             * Produtos
             */
            $rules = array_merge($rules, $this->produtos($content));

        } elseif($content->operacao->nfe_complementar == 'impostos') {

            /**
             * Impostos nota complementar
             */
            $rules = array_merge($rules, $this->impostosComplementar($content));

        }

        return $rules;
    }

    /**
     * Validação dados nota de ajuste
     */
    private function ajuste($content) {

        $rules = [
            'impostos.situacao_tributaria' => ['required'],
            'impostos.codigo_cfop' => ['required'],
            'impostos.valor_icms' => ['required']
        ];

        /**
         * Cliente
         */
        $rules = array_merge($rules, $this->cliente($content));

        return $rules;
    }

    /**
     * Validação dos dados da carta de correção
     */
    private function cartaCorrecao($content) {

        $rules = [
            'carta_correcao.chave' => ['required'],
            'carta_correcao.correcao' => ['required']
        ];

       return $rules;
    }

    /**
     * Validação dos dados do inutilizar numeração
     */
    private function inutilizarNumeracao($content) {

        $rules = [
            'impostos.serie' => ['required'],
            'impostos.numeracao_inicial' => ['required'],
            'impostos.numeracao_final' => ['required'],
            'impostos.motivo_inutilizacao' => ['required'],
        ];

       return $rules;
    }

    /**
     * Validação dados cliente
     */
    private function cliente($content) {

        $cliente = [
            'cliente.tipo_pessoa' => ['required'],
        ];

        if(!empty($content->cliente) && property_exists($content->cliente, 'tipo_pessoa')) {
            
            if($content->cliente->tipo_pessoa == Cliente::TIPO_PESSOA_JURIDICA) {
                $cliente = array_merge($cliente, [
                    'cliente.cpf_cnpj' => ['required'],
                    'cliente.razao_social' => ['required'],
                ]);
            } else if($content->cliente->tipo_pessoa == Cliente::TIPO_PESSOA_FISICA) {
                $cliente = array_merge($cliente, [
                    'cliente.cpf_cnpj' => ['required'],
                    'cliente.nome_completo' => ['required'],
                ]);
            } else {
                $cliente = array_merge($cliente, [
                    'cliente.nome_completo' => ['required'],
                ]);
            }
        }

        if($content->cliente->tipo_pessoa != Cliente::TIPO_ESTRANGEIRO) {
            $cliente = array_merge($cliente, [
                'cliente.cidade' => ['required'],
                'cliente.cep' => ['required'],
            ]);
        }         
        
        $cliente = array_merge($cliente, [
            'cliente.endereco' => ['required'],
            'cliente.numero' => ['required'],
            'cliente.bairro' => ['required'],
            'cliente.uf' => ['required'],           
        ]);

        return $cliente;
    }

    /**
     * Validação dados produtos
     */
    private function produtos($content) {

        $produtos = [
            'produtos.*.quantidade' => ['required'],
            'produtos.*.subtotal' => ['required'],
            'produtos.*.total' => ['required'],
        ];

        return $produtos;
    }

    /**
     * Validação dos dados de impostos na nota complementar
     */
    private function impostosComplementar($content) {

        $impostos = [
            'impostos.codigo_cfop' => ['required']
        ];

        if($content->impostos->show_form_icms) {
            $impostos = array_merge($impostos, [
                'impostos.situacao_tributaria_icms' => ['required'],
                'impostos.bc_icms' => ['required'],
                'impostos.valor_icms' => ['required'],
            ]);
        }

        if($content->impostos->show_form_icms_st) {
            $impostos = array_merge($impostos, [
                'impostos.situacao_tributaria_icms_st' => ['required'],
                'impostos.bc_icms_st' => ['required'],
                'impostos.valor_icms_st' => ['required'],
                'impostos.aliquota_mva' => ['required'],
            ]);
        }

        if($content->impostos->show_form_ipi) {
            $impostos = array_merge($impostos, [
                'impostos.bc_ipi' => ['required'],
                'impostos.valor_ipi' => ['required'],
            ]);
        }

       return $impostos;
    }

}
