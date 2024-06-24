<?php

namespace App\Services;

class NotaFiscalService
{
    /*
    {
        "ID": 1137,
        "url_notificacao": "http://meudominio.com/retorno.php",
        "operacao": 1,
        "natureza_operacao": "Venda de produção do estabelecimento",
        "modelo": 1,
        "finalidade": 1,
        "ambiente": 2,
        "cliente": {
            "cpf": "000.000.000-00",
            "nome_completo": "Nome do Cliente",
            "endereco": "Av. Brg. Faria Lima",
            "complemento": "Escritório",
            "numero": 1000,
            "bairro": "Itaim Bibi",
            "cidade": "São Paulo",
            "uf": "SP",
            "cep": "00000-000",
            "telefone": "(00) 0000-0000",
            "email": "nome@email.com"
        },
        "produtos": [{
            "nome": "Nome do produto",
            "codigo": "nome-do-produto",
            "ncm": "6109.10.00",
            "cest": "28.038.00",
            "quantidade": 3,
            "unidade": "UN",
            "peso": "0.800",
            "origem": 0,
            "subtotal": "44.90",
            "total": "134.70",
            "classe_imposto": "REF1000"
        }, 
        {
            "nome": "Nome do produto",
            "codigo": "nome-do-produto",
            "ncm": "6109.10.00",
            "cest": "28.038.00",
            "quantidade": 1,
            "unidade": "UN",
            "peso": "0.800",
            "origem": 0,
            "subtotal": "29.90",
            "total": "29.90",
            "classe_imposto": "REF1000"
        }],
        "pedido": {
            "pagamento": 0,
            "presenca": 2,
            "modalidade_frete": 0,
            "frete": "12.56",
            "desconto": "10.00",
            "total": "174.60"
        }
    }
    */


    public static function cadastrar($dados)
    {
        return false;
    }
    
}