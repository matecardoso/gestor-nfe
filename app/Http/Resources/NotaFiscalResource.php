<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotaFiscalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'chave' => $this->chave,
            'produtos' => data_get($this->dados_formulario, 'produtos'),
            'serie'  => data_get($this->dados_retorno, 'serie'),
            'numero' => data_get($this->dados_retorno, 'nfe'),
            'finalidade' => data_get($this->dados_envio, 'finalidade'),
            'operacao' => data_get($this->dados_envio, 'operacao'),
            'natureza_operacao' => data_get($this->dados_envio, 'natureza_operacao'),
            'cliente' => data_get($this->dados_envio, 'cliente.nome') ?: (data_get($this->dados_envio, 'cliente.razao_social') ?: data_get($this->dados_envio, 'cliente.nome_estrangeiro', '')),
            'valor' => data_get($this->dados_envio, 'finalidade') != 2 ? data_get($this->dados_envio, 'pedido.total') : '0,00',
            'data' => data_get($this->dados_retorno, 'log') ? data_get($this->dados_retorno, 'log.dhRecbto') : '',
            'status' => !$this->dados_cancelamento && data_get($this->dados_retorno, 'status') ? data_get($this->dados_retorno, 'status') : data_get($this->dados_cancelamento, 'status'),
            'cancelada' => $this->dados_cancelamento ? true : false
        ];
        
        // return parent::toArray($request);
    }
}
