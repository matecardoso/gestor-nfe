<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
            'Nome/Razão social'  => $this->tipo_pessoa == 'pessoa-juridica' ? $this->razao_social : $this->nome_completo,
            'CPF/CNPJ' => formatCnpjCpf($this->cpf_cnpj)
        ];
        
        // return parent::toArray($request);
    }
}
