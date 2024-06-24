<?php

namespace App\Http\Resources\Produto;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaProdutosResource extends JsonResource
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
            'id'     => $this->id,
            'Nome'   => $this->nome,
            'Código' => $this->codigo,
            'NCM'    => $this->ncm,
            'Valor'  => $this->subtotal
        ];
        
        // return parent::toArray($request);
    }
}
