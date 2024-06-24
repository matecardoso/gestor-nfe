<?php

namespace App\Services;

use WebmaniaBR\NFe;
use App\Services\WebManiaBrConnector;

class WebManiaBrService
{
    function __construct(){
        $this->webmaniabr = new WebManiaBrConnector(config('webmaniabr.credenciais', ''));
    }
    
    public function emissao($dados)
    {
        $response = $this->webmaniabr->emissaoNotaFiscal($dados);
        return $this->finalizar($response, 'emissao');
    }

    public function ajuste($dados)
    {
        $response = $this->webmaniabr->ajusteNotaFiscal($dados);
        return $this->finalizar($response, 'ajuste');
    }

    public function complementar($dados)
    {
        $response = $this->webmaniabr->complementarNotaFiscal($dados);
        return $this->finalizar($response, 'complementar');
    }

    public function devolucao($chave, $natureza_operacao, $ambiente, $codigo_cfop, $produtos, $quntidades, $classe_imposto = null)
    {
        $response = $this->webmaniabr->devolucaoNotaFiscal($chave, $natureza_operacao, $ambiente, $codigo_cfop, $classe_imposto, $produtos, $quntidades);
        return $this->finalizar($response, 'devolucao');
    }

    public function cancelar($chave, $motivo)
    {
        $response = $this->webmaniabr->cancelarNotaFiscal($chave, $motivo);
        return $this->finalizar($response, 'cancelar');
    }

    public function consulta($chave)
    {
        $response = $this->webmaniabr->consultaNotaFiscal($chave);
        return $this->finalizar($response, 'consulta');
    }

    public function cartaCorrecao($dados)
    {
        $response = $this->webmaniabr->cartaCorrecao($dados['chave'], $dados['correcao']);
        return $this->finalizar($response, 'cartaCorrecao');
    }

    public function inutilizarNumeracao($dados)
    {
        $response = $this->webmaniabr->inutilizarNumeracao($dados['sequencia'], $dados['motivo'], $dados['ambiente']);
        return $this->finalizar($response, 'inutilizarNumeracao');
    }

    private function finalizar($response, $tipo) {

        // Retorno
        if (isset($response->error)){

            // echo '<h2>Erro: '.$response->error.'</h2>';

            $res = [
                'error' => $response->error,
            ];

            if (isset($response->log)){

                $res['log'] = $response->log;

                // echo '<h2>Log:</h2>';
                // echo '<ul>';
                // foreach ($response->log as $erros){
                //     foreach ($erros as $erro) {
                //         echo '<li>'.$erro.'</li>';
                //     }
                // }
                // echo '</ul>';
            }

            return $res;

        } else {
            if($tipo == 'cancelar') {

                // echo '<h2>Resultado do Cancelamento:</h2>';

                return [
                    'tipo' => $tipo,
                    'status' => (string) $response->status,
                    'xml' => (string) $response->xml,
                    'log' => $response->log,
                ];

            } else {

                // echo '<h2>NF-e enviada com sucesso.</h2>';

                return [
                    'tipo' => $tipo,
                    'uuid' => (string) $response->uuid, // Número único de identificação da Nota Fiscal
                    'status' => (string) $response->status, // aprovado, reprovado, cancelado, processamento ou contingencia
                    'nfe' => (int) $response->nfe, // Número da NF-e
                    'serie' => (int) $response->serie, // Número de série
                    'recibo' => isset($response->recibo) ? (int) $response->recibo : null, // Número do recibo
                    'chave' => $response->chave, // Número da chave de acesso
                    'xml' => (string) $response->xml, // URL do XML
                    'danfe' => (string) $response->danfe, // URL do Danfe (PDF)
                    'log' => $response->log, // Log do Sefaz
                ];

            }            
        }

        return false;
    }
    
}