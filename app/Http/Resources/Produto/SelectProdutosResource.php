<?php

namespace App\Http\Resources\Produto;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectProdutosResource extends JsonResource
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
            'nome'   => $this->nome,
        ];

        // return parent::toArray($request);
    }
}
