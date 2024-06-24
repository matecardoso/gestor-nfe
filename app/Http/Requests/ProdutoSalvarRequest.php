<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoSalvarRequest extends FormRequest
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
        // dd(json_decode($this->getContent()));

        $rules = [
            'nome' => ['required'],
            'ncm' => ['required'],
            'unidade' => ['required'],
            'origem' => ['required'],
            'subtotal' => ['required'],
            // 'impostos.icms.codigo_cfop' => ['required'],
            'impostos.icms.situacao_tributaria' => ['required'],
            'impostos.icms.tipo_tributacao' => ['required'],
            'impostos.ipi.situacao_tributaria' => ['required'],
            'impostos.ipi.codigo_enquadramento' => ['required'],
            'impostos.ipi.aliquota' => ['required'],
            'impostos.pis.situacao_tributaria' => ['required'],
            'impostos.pis.aliquota' => ['required'],
            'impostos.cofins.aliquota' => ['required'],
            'impostos.cofins.aliquota' => ['required'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [     
            'required' => 'O campo é obrigatório'
        ]; 
    }
}
