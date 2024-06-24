<?php

namespace App\Http\Resources\Produto;

use Illuminate\Http\Resources\Json\JsonResource;

class ImpostosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $impostos = $this->impostos;

        return [
            'icms' => $impostos->icms ? $impostos->icms->toArray() : newObject(),
            'ipi' => $impostos->ipi ? $impostos->ipi->toArray() : newObject(),
            'pis' => $impostos->pis ? $impostos->pis->toArray() : newObject(),
            'cofins' => $impostos->cofins ? $impostos->cofins->toArray() : newObject(),
            'estimativa' => [
                'tributos_federais' => $this->tributos_federais ?? newObject(),
                'tributos_estaduais' => $this->tributos_estaduais ?? newObject()
            ],
            'importacao' => $impostos->importacao ? $impostos->importacao->toArray() : newObject(),
            'exportacao' => $impostos->exportacao ? $impostos->exportacao->toArray() : newObject()
        ];

        // return parent::toArray($request);
    }
}
