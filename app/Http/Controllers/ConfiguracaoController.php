<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use Illuminate\Http\Request;
use App\Http\Resources\Configuracao\UnidadeResource;

class ConfiguracaoController extends Controller
{
    public function unidades() {

        if(request()->input('select')){
            return response()->json(Configuracao::tipoUnidade()->get()->pluck('descricao', 'valor'));
        };

        return response()->json(Configuracao::tipoUnidade()->get()->toArray());
    }

    public function cadastroUnidade() {

        Configuracao::create([
            'tipo' => Configuracao::TIPO_UNIDADE,
            'descricao' => request()->get('nome'),
            'valor' => request()->get('sigla')
        ]);

        return response()->json("Cadastro realizado com sucesso", 200);
    }
}



