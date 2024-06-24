<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Endereco;

class ClienteService
{

    public static function salvar($dados)
    {
        if(array_key_exists('cpf_cnpj',$dados)) {
            $dados['cpf_cnpj'] = apenasNumeros($dados['cpf_cnpj']);
        }

        if(array_key_exists('telefone',$dados)) {
            $dados['telefone'] = apenasNumeros($dados['telefone']);
        }

        $cliente = Cliente::where('cpf_cnpj', $dados['cpf_cnpj'])->first();

        if($cliente) {
            $endereco = $cliente->endereco;
            $endereco->update($dados);
            $cliente->update($dados);
        } else if(array_key_exists('id', $dados)) {
            $cliente = Cliente::findOrFail($dados['id']);
            if($endereco = Endereco::find($dados['endereco_id'])) {
                $endereco->fill($dados);
                $endereco->save();
            } else {
                $endereco = Endereco::create($dados);
                $cliente->endereco_id = $endereco->id;
            }
            $cliente->fill($dados);
            $cliente->save();
        } else {
            $endereco = Endereco::create($dados);
            $cliente = new Cliente;
            $cliente->fill($dados);
            $cliente->endereco_id = $endereco->id;
            $cliente->save();
        };


        return false;
    }
    
}