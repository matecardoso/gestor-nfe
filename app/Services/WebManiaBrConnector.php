<?php

namespace App\Services;

class WebManiaBrConnector {

    function __construct( array $vars ){

        $this->consumerKey = $vars['consumer_key'];
        $this->consumerSecret = $vars['consumer_secret'];
        $this->accessToken = $vars['access_token'];
        $this->accessTokenSecret = $vars['access_token_secret'];

    }

    function statusSefaz( $data = null ){

        $data = array();
        $response = $this->connectWebmaniaBR( 'GET', 'https://webmaniabr.com/api/1/nfe/sefaz/', $data );
        if (isset($response->error)) return $response;
        if ($response->status == 'online') return true;
        else return false;

    }

    function validadeCertificado( $data = null ){

        $data = array();
        $response = $this->connectWebmaniaBR( 'GET', 'https://webmaniabr.com/api/1/nfe/certificado/', $data );
        if (isset($response->error)) return $response;
        return $response->expiration;

    }

    function emissaoNotaFiscal( array $data ){

        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/emissao/', $data );
        return $response;

    }

    function consultaNotaFiscal( $chave ){

        $data = array();
        $data['chave'] = $chave;
        $response = $this->connectWebmaniaBR( 'GET', 'https://webmaniabr.com/api/1/nfe/consulta/', $data );
        return $response;

    }

    function cancelarNotaFiscal( $chave, $motivo ){

        $data = array();
        $data['chave'] = $chave;
        $data['motivo'] = $motivo;
        $response = $this->connectWebmaniaBR( 'PUT', 'https://webmaniabr.com/api/1/nfe/cancelar/', $data );
        return $response;

    }

    function inutilizarNumeracao( $sequencia, $motivo, $ambiente ){

        $data = array();
        $data['sequencia'] = $sequencia;
        $data['motivo'] = $motivo;
        $data['ambiente'] = $ambiente;
        $response = $this->connectWebmaniaBR( 'PUT', 'https://webmaniabr.com/api/1/nfe/inutilizar/', $data );
        return $response;

    }

    function cartaCorrecao( $chave, $correcao ){

        $data = array();
        $data['chave'] = $chave;
        $data['correcao'] = $correcao;
        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/cartacorrecao/', $data );
        return $response;

    }

    function devolucaoNotaFiscal( $chave, $natureza_operacao, $ambiente, $codigo_cfop = null, $classe_imposto = null, $produtos = null, $quantidades = null){

        $data = array();
        $data['chave'] = $chave;
        $data['natureza_operacao'] = $natureza_operacao;
        $data['ambiente'] = $ambiente;
        $data['codigo_cfop'] = $codigo_cfop;
        $data['classe_imposto'] = $classe_imposto;
        $data['produtos'] = $produtos;
        $data['quantidades'] = $quantidades;
        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/devolucao/', $data );
        return $response;

    }

    function ajusteNotaFiscal( $data ){
        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/ajuste/', $data );
        return $response;
    }

    function complementarNotaFiscal( $data ) {

        // $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/nfe_referenciada/', $data);
        $response = $this->connectWebmaniaBR( 'POST', 'https://webmaniabr.com/api/1/nfe/complementar/', $data);
        return $response;
    }

    function connectWebmaniaBR( $request, $endpoint, $data ){

        @set_time_limit( 300 );
        ini_set('max_execution_time', 300);
        ini_set('max_input_time', 300);
        ini_set('memory_limit', '256M');

        $headers = array(
          'Cache-Control: no-cache',
          'Content-Type:application/json',
          'X-Consumer-Key: '.$this->consumerKey,
          'X-Consumer-Secret: '.$this->consumerSecret,
          'X-Access-Token: '.$this->accessToken,
          'X-Access-Token-Secret: '.$this->accessTokenSecret
        );

        $rest = curl_init();
        curl_setopt($rest, CURLOPT_CONNECTTIMEOUT , 300);
        curl_setopt($rest, CURLOPT_TIMEOUT, 300);
        curl_setopt($rest, CURLOPT_URL, $endpoint.'?time='.time());
        curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($rest, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($rest, CURLOPT_CUSTOMREQUEST, $request);
        curl_setopt($rest, CURLOPT_POSTFIELDS, json_encode( $data ));
        curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($rest, CURLOPT_FRESH_CONNECT, true);
        $response = curl_exec($rest);
        curl_close($rest);

        return json_decode($response);

    }

}
