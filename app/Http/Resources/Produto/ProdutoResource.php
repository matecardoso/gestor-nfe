<?php

namespace App\Http\Resources\Produto;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
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
            'item' => $this->item,
            'nome' => $this->nome,
            'codigo' => $this->codigo,
            'ncm' => $this->ncm,
            'quantidade' => $this->quantidade,
            'unidade' => $this->unidade,
            'peso' => $this->peso,
            'origem' => $this->origem,
            'desconto' => $this->desconto,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'classe_imposto' => $this->classe_imposto,
            'veiculo_usado' => $this->veiculo_usado,
            'ind_escala' => $this->ind_escala,
            'cnpj_fabricante' => $this->cnpj_fabricante,
            'beneficio_fiscal' => $this->beneficio_fiscal,
            'gtin' => $this->gtin,
            'gtin_tributavel' => $this->gtin_tributavel,
            'cest' => $this->cest,
            'nve' => $this->nve,
            'nrecopi' => $this->nrecopi,
            'informacoes_adicionais' => $this->informacoes_adicionais,
            'ativo_permanente' => $this->ativo_permanente,
            'tributos_federais' => $this->tributos_federais,
            'impostos' => new ImpostosResource($this)
        ];

        // return parent::toArray($request);
    }
}
