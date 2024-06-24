<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Model;

class WebManiaBr extends Model
{
    public function normalizaDadosEmissaoNota(Array $dados) {

        $operacoes = $dados['operacao'];

        // 1 : 'NF-e normal'
        // 2 : 'NF-e complementar'
        // 3 : 'NF-e de ajuste'
        // 4 : 'Devolução/Retorno'
        // 5 : 'Carta de Correção'
        // 6 : 'Inutilizar Numeração'

        // return response()->json($dados);

        if($operacoes['finalidade'] == 1 || $operacoes['finalidade'] == 4) {

            $rules = [
                'operacao' => intval($operacoes['operacao']),
                'natureza_operacao' => $operacoes['natureza_operacao'],
                'modelo' => $operacoes['modelo'],
                'finalidade' => intval($operacoes['finalidade']),
                'ambiente' => $operacoes['ambiente'],

                'cliente' => $this->cliente($dados['cliente']),
                'produtos' => $this->produtos($dados['produtos']),
                'pedido' => $this->pedido($dados['pedido']),
                'transporte' => $this->transporte($dados['transporte'])
            ];

            if($data_emissao = data_get($operacoes, 'data_emissao')) {
                $rules['data_emissao'] = Carbon::parse($data_emissao)->format('Y-m-d h:i:s');
            }

            if($xped = data_get($operacoes, 'xped')) {
                $rules['ID'] = $xped;
            };

            $parcelas = data_get($dados, 'pedido.parcelas');
            if($parcelas && $parcelas[0] && !empty($parcelas[0])) {
                $rules['parcelas'] = $parcelas;
            }
            
            if($fatura = data_get($dados, 'pedido.fatura')) {
                $rules['fatura'] = $fatura;
            }

            if($operacoes['finalidade'] == 4) {
                $rules = array_merge($rules, [
                    'chave' => $operacoes['nfe_referenciada']
                ]);
            }

            return limpaNulosArray($rules);
            
        } elseif($operacoes['finalidade'] == 2) {

            $rules = [
                'nfe_referenciada' => $operacoes['nfe_referenciada'],
                'operacao' => intval($operacoes['operacao']),
                'natureza_operacao' => $operacoes['natureza_operacao'],
                'modelo' => $operacoes['modelo'],
                'finalidade' => intval($operacoes['finalidade']),
                'ambiente' => $operacoes['ambiente'],

                'cliente' => $this->cliente($dados['cliente'])
            ];

            if($operacoes['nfe_complementar'] == 'preco_quantidade') {
                $rules['produtos'] = $this->produtos($dados['produtos']);
            } elseif($operacoes['nfe_complementar'] == 'impostos') {
                $rules['impostos'] = $this->impostosComplementar($dados['impostos']);
            }

            return limpaNulosArray($rules);

        } elseif($operacoes['finalidade'] == 3) {
            
            $rules = [
                'operacao' => intval($operacoes['operacao']),
                'natureza_operacao' => $operacoes['natureza_operacao'],
                'codigo_cfop' => $operacoes['codigo_cfop'],
                'valor_icms' => intval($operacoes['valor_icms']),
                'finalidade' => intval($operacoes['finalidade']),
                'ambiente' => $operacoes['ambiente'],

                'cliente' => $this->cliente($dados['cliente']),

                'situacao_tributaria' => $operacoes['situacao_tributaria'],
                'informacoes_fisco' => $operacoes['informacoes_fisco'],
                'informacoes_complementares' => $operacoes['informacoes_complementares'],
            ];

            return limpaNulosArray($rules);

        } elseif($operacoes['finalidade'] == 5) {

            $rules = [
                'chave' => intval($dados['carta_correcao']['chave']),
                'correcao' => $dados['carta_correcao']['correcao'],
                'finalidade' => intval($operacoes['finalidade']),
            ];

            return limpaNulosArray($rules);

        } elseif($operacoes['finalidade'] == 6) {

            $rules = [
                'sequencia' => $operacoes['numeracao_inicial'] . '-' . $operacoes['numeracao_final'],
                'motivo' => $operacoes['motivo_inutilizacao'],
                'finalidade' => intval($operacoes['finalidade']),
                'ambiente' => $operacoes['ambiente'],
                'serie' => $operacoes['serie'],
                'modelo' => $operacoes['modelo'],
            ];

            return limpaNulosArray($rules);
        };

        return false;

    }

    public function cliente(Array $cliente) {

        if($cliente['tipo_pessoa'] == Cliente::TIPO_PESSOA_FISICA) {
            $rules = [
                'cpf' => soNumeros(data_get($cliente, 'cpf_cnpj')),
                'nome_completo' => data_get($cliente, 'nome_completo'),
                'suframa' => data_get($cliente, 'suframa')
            ];
        } elseif($cliente['tipo_pessoa'] == Cliente::TIPO_PESSOA_JURIDICA) {
            $rules = [
                'cnpj' => soNumeros(data_get($cliente, 'cpf_cnpj')),
                'razao_social' => data_get($cliente, 'razao_social'),
            ];
        } elseif($cliente['tipo_pessoa'] == Cliente::TIPO_ESTRANGEIRO) {
            $rules = [
                'nome_estrangeiro' => data_get($cliente, 'nome_completo'),
                'cod_pais' => data_get($cliente, 'uf'),
                'nome_pais' => paises()[data_get($cliente, 'uf')],
            ];
        };

        if($cliente['tipo_pessoa'] != Cliente::TIPO_ESTRANGEIRO) {
            $rules = array_merge($rules, [
                'ie' => data_get($cliente, 'ie'),
                'substituto_tributario' => data_get($cliente, 'substituto_tributario'),
                'consumidor_final' => data_get($cliente, 'consumidor_final'),
                'contribuinte' => data_get($cliente, 'contribuinte'),
                'cidade' => data_get($cliente, 'cidade'),
                'cep' => soNumeros(data_get($cliente, 'cep')),
                'telefone' => soNumeros(data_get($cliente, 'telefone')),
                'email' => data_get($cliente, 'email'),
                'uf' => data_get($cliente, 'uf'),
            ]);
        }

        $rules = array_merge($rules, [
            'endereco' => data_get($cliente, 'endereco'),
            'complemento' => data_get($cliente, 'complemento'),
            'numero' => data_get($cliente, 'numero'),
            'bairro' => data_get($cliente, 'bairro'),
        ]);

        return $rules;
    }

    public function produtos(Array $dados) {

        $produtos = [];

        foreach($dados as $i => $produto) { 
            if($impostosImportacao = data_get($produto, 'impostos.importacao')) {
                array_push($produtos, array_merge($this->produto($produto), $this->produtoImportacao($impostosImportacao)));
            } else {
                array_push($produtos, $this->produto($produto));
            }
        }

        return $produtos;
    }

    public function produto(Array $produto) {
        return [
            'item' => data_get($produto, 'item'),
            'nome' => data_get($produto, 'nome'),
            'codigo' => data_get($produto, 'codigo'),
            'ncm' => data_get($produto, 'ncm'),
            'cest' => data_get($produto, 'cest'),
            'quantidade' => data_get($produto, 'quantidade'),
            'unidade' => data_get($produto, 'unidade'),
            // 'peso' => data_get($produto, 'peso'), //Falta informar (Se unidade for de peso unidade*quantidade -- Caso não seja informado o peso do produto é obrigatório informar o Peso Bruto e Peso Líquido dentro da array transporte.)
            'origem' => data_get($produto, 'origem'),
            'desconto' => data_get($produto, 'desconto'),

            'subtotal' => data_get($produto, 'subtotal'),
            'total' => data_get($produto, 'total'),

            'gtin' => data_get($produto, 'gtin'),
            'gtin_tributavel' => data_get($produto, 'gtin_tributavel'),

            // 'classe_imposto' => data_get($produto, 'classe_imposto'), //classe de imposto cadastrado no painel de controle da WebmaniaBR (Falta informar)

            // 'tributos_federais' => data_get($produto, 'impostos.estimativa.tributos_federais'),
            // 'tributos_estaduais' => data_get($produto, 'impostos.estimativa.tributos_estaduais'),
            
            // 'rastro' => $this->rastro($produto['rastro']),
            'impostos' => $this->impostos($produto)
        ];
    }

    public function produtoImportacao(Array $dados) {
        return [
            // 'subtotal' => data_get($dados, 'subtotal'),
            // 'total' => data_get($dados, 'total'),
            'ndoc_importacao' => data_get($dados, 'ndoc_importacao'),
            'ddoc_importacao' => data_get($dados, 'ddoc_importacao'),
            'local_desembaraco' => data_get($dados, 'local_desembaraco'),
            'uf_desembaraco' => data_get($dados, 'uf_desembaraco'),
            'data_desembaraco' => data_get($dados, 'data_desembaraco'),
            'via_transporte' => data_get($dados, 'via_transporte'),
            'intermediacao' => data_get($dados, 'intermediacao'),
            'adicao' => data_get($dados, 'adicao'),
            'seq_adicao' => data_get($dados, 'seq_adicao'),
            'fabricante' => data_get($dados, 'fabricante'),
            'afrmm' => data_get($dados, 'afrmm'),
            'cnpj_terceiro' => data_get($dados, 'cnpj_terceiro'),
            'uf_terceiro' => data_get($dados, 'uf_terceiro'),
            'cod_exportador' => data_get($dados, 'cod_exportador'),
            'nfci' => data_get($dados, 'nfci'),
        ];
    }

    // public function rastro(Array $dados) {
    //     return [
    //         'lote' => data_get($dados, 'lote'),
    //         'quantidade' => data_get($dados, 'quantidade'),
    //         'data_fabricacao' => data_get($dados, 'data_fabricacao'),
    //         'data_validade' => data_get($dados, 'data_validade'),
    //         'codigo_agregacao' => data_get($dados, 'codigo_agregacao'),
    //     ];
    // }

    public function impostos(Array $produto) {

        $impostos = $produto['impostos'];

        $cfop = array_key_exists('codigo_cfop', $produto) ? $produto['codigo_cfop'] : null;

        $dados = [
            'icms' => $this->icms($impostos['icms'], $cfop),
            'ipi' => $this->ipi($impostos['ipi']),
            'pis' => $this->pis($impostos['pis']),
            'cofins' => $this->cofins($impostos['cofins'])
        ];

        if(data_get($impostos, 'importacao')) {
            $dados = array_merge($dados, [
                'importacao' => $this->impostoImportacao(data_get($impostos, 'importacao'))
            ]);
        };

        return $dados;
    }

    public function icms(Array $dados, $cfop = null) {
        return [
            'codigo_cfop' => $cfop ?: data_get($dados, 'codigo_cfop'),
            'situacao_tributaria' => data_get($dados, 'situacao_tributaria'),
            'aliquota_reducao' => data_get($dados, 'aliquota_reducao'),
            'aliquota_credito' => data_get($dados, 'aliquota_credito'),
            'aliquota_mva' => data_get($dados, 'aliquota_mva'),
            'aliquota_diferimento' => data_get($dados, 'aliquota_diferimento'),
            'aliquota_importacao' => data_get($dados, 'aliquota_importacao'),
            'aliquota_reducao_st' => data_get($dados, 'aliquota_reducao_st'),
            'motivo_desoneracao' => data_get($dados, 'motivo_desoneracao'),
            'bc_st_retido' => data_get($dados, 'bc_st_retido'),
            'aliquota_st_retido' => data_get($dados, 'aliquota_st_retido'),
            'valor_st_retido' => data_get($dados, 'valor_st_retido'),
            'valor_fcp_retido' => data_get($dados, 'valor_fcp_retido'),
            'aliquota_fcp_retido' => data_get($dados, 'aliquota_fcp_retido'),
            'icms_efetivo' => data_get($dados, 'icms_efetivo'),
            'industria' => data_get($dados, 'industria'),
        ];
    }

    public function ipi(Array $dados) {
        return [
            'situacao_tributaria' => data_get($dados, 'situacao_tributaria'),
            'codigo_enquadramento' => data_get($dados, 'codigo_enquadramento'),
            'aliquota' => strnum(data_get($dados, 'aliquota')),
            'codigo_selo' => data_get($dados, 'codigo_selo'),
            'qtd_selo' => data_get($dados, 'qtd_selo'),
        ];
    }

    public function pis(Array $dados) {
        return [
            'situacao_tributaria' => data_get($dados, 'situacao_tributaria'),
            'aliquota' => strnum(data_get($dados, 'aliquota')),
        ];
    }

    public function cofins(Array $dados) {
        return [
            'situacao_tributaria' => data_get($dados, 'situacao_tributaria'),
            'aliquota' => strnum(data_get($dados, 'aliquota')),
        ];
    }

    public function impostoImportacao(Array $dados = []) {
        return [
            'aliquota' => strnum(data_get($dados, 'aliquota')),
            'iof' => strnum(data_get($dados, 'iof')),
        ];
    }

    public function pedido(Array $dados) {

        $pedido = [
            'presenca' => data_get($dados, 'presenca'),
            'modalidade_frete' => data_get($dados, 'modalidade_frete'),
            'frete' => data_get($dados, 'frete'),
            'desconto' => data_get($dados, 'desconto'),
            // 'total' => data_get($dados, 'total'),
            'despesas_acessorias' => data_get($dados, 'despesas_acessorias'),
            'despesas_aduaneiras' => data_get($dados, 'despesas_aduaneiras'),
            'informacoes_fisco' => data_get($dados, 'informacoes_fisco'),
            'informacoes_complementares' => data_get($dados, 'informacoes_complementares'),
            'observacoes_contribuinte' => data_get($dados, 'observacoes_contribuinte'),
        ];

        $pagamento = data_get($dados, 'pagamento');
        if($pagamento && $pagamento[0] && !empty($pagamento[0])) {
            
            foreach($pagamento as $i => $pag) {
                foreach($pag as $j => $p) {
                    if(!isset($pedido['pagamento'][$j])) {
                        $pedido['pagamento'][$j] = array($p);
                    } else {
                        array_push($pedido['pagamento'][$j], $p);
                    }
                };
            }

        }

        return $pedido;
    }

    public function transporte(Array $transporte) {
        return [
            'volume' => data_get($transporte, 'volume'),
            'especie' => data_get($transporte, 'especie'),
            'peso_bruto' => data_get($transporte, 'peso_bruto'),
            'peso_liquido' => data_get($transporte, 'peso_liquido'),
            'marca' => data_get($transporte, 'marca'),
            'numeracao' => data_get($transporte, 'numeracao'),
            'lacres' => data_get($transporte, 'lacres'),
            'cnpj' => data_get($transporte, 'cnpj'),
            'razao_social' => data_get($transporte, 'razao_social'),
            'ie' => data_get($transporte, 'ie'),
            'cpf' => data_get($transporte, 'cpf'),
            'nome_completo' => data_get($transporte, 'nome_completo'),
            'endereco' => data_get($transporte, 'endereco'),
            'uf' => data_get($transporte, 'uf'),
            'cidade' => data_get($transporte, 'cidade'),
            'cep' => data_get($transporte, 'cep'),
            'placa' => data_get($transporte, 'placa'),
            'uf_veiculo' => data_get($transporte, 'uf_veiculo'),
            'rntc' => data_get($transporte, 'rntc'),
            'seguro' => data_get($transporte, 'seguro'),
            'reboque_placa' => data_get($transporte, 'reboque_placa'),
            'reboque_uf_veiculo' => data_get($transporte, 'reboque_uf_veiculo'),
            'reboque_rntc' => data_get($transporte, 'reboque_rntc'),
            'vagao' => data_get($transporte, 'vagao'),
            'balsa' => data_get($transporte, 'balsa'),
        ];
    }

    public function impostosComplementar(Array $impostos) {
        
        $rules = [
            'codigo_cfop' => data_get($impostos, 'codigo_cfop')
        ];

        if(data_get($impostos, 'show_form_icms')) {
            $rules = array_merge($rules, [
                'situacao_tributaria' => data_get($impostos, 'situacao_tributaria_icms'),
                'bc_icms' => data_get($impostos, 'bc_icms'),
                'valor_icms' => data_get($impostos, 'valor_icms')
            ]);
        }

        if(data_get($impostos, 'show_form_icms_st')) {
            $rules = array_merge($rules, [
                'situacao_tributaria' => data_get($impostos, 'situacao_tributaria_icms_st'),
                'bc_icms_st' => data_get($impostos, 'bc_icms_st'),
                'valor_icms_st' => data_get($impostos, 'valor_icms_st'),
                'aliquota_mva' => data_get($impostos, 'aliquota_mva'),
            ]);
        }

        if(data_get($impostos, 'show_form_ipi')) {
            $rules = array_merge($rules, [
                'bc_ipi' => data_get($impostos, 'bc_ipi'),
                'valor_ipi' => data_get($impostos, 'valor_ipi')
            ]);
        }

        return $rules;
    }
} 