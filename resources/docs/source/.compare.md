---
title: API Reference

language_tabs:
- php
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://nfc.gestor/docs/collection.json)

<!-- END_INFO -->

#Cliente


<!-- START_5949b4aa2e62a631159e6f626e670156 -->
## Salvar/Editar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Salva um novo cliente ou sobrescreve os dados de um cliente já existente

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/cliente/salvar',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'json' => [
            'id' => 1,
            'tipo_pessoa' => '1',
            'nome_completo' => '1',
            'cpf_cnpj' => '1',
            'consumidor_final' => '1',
            'cep' => '1',
            'endereco' => '1',
            'numero' => '1',
            'complemento' => '1',
            'bairro' => '1',
            'cidade' => '1',
            'uf' => '1',
            'email' => '1',
            'telefone' => '1',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/cliente/salvar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

let body = {
    "id": 1,
    "tipo_pessoa": "1",
    "nome_completo": "1",
    "cpf_cnpj": "1",
    "consumidor_final": "1",
    "cep": "1",
    "endereco": "1",
    "numero": "1",
    "complemento": "1",
    "bairro": "1",
    "cidade": "1",
    "uf": "1",
    "email": "1",
    "telefone": "1"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST cliente/salvar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  optional  | Informar no caso de edição de dados de um cliente
        `tipo_pessoa` | string |  required  | 
        `nome_completo` | string |  required  | 
        `cpf_cnpj` | string |  required  | 
        `consumidor_final` | string |  optional  | 
        `cep` | string |  required  | 
        `endereco` | string |  required  | 
        `numero` | string |  required  | 
        `complemento` | string |  required  | 
        `bairro` | string |  required  | 
        `cidade` | string |  required  | 
        `uf` | string |  required  | 
        `email` | string |  required  | 
        `telefone` | string |  required  | 
    
<!-- END_5949b4aa2e62a631159e6f626e670156 -->

<!-- START_ed72646383beb603ab7060d0b14a422a -->
## Cliente

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Retorna um objeto contendo dados de um cliente cadastrado

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/cliente/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/cliente/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET cliente/{cliente}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `cliente` |  optional  | Id do cliente

<!-- END_ed72646383beb603ab7060d0b14a422a -->

<!-- START_83555366ce3e1201a2e2a6bfc33a0b90 -->
## Clientes

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Retorna um objeto contendo dados dos clientes cadastrados

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/clientes',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'query' => [
            'paginate' => '0',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/clientes"
);

let params = {
    "paginate": "0",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "Nome\/Razão social": "Shanel Shanahan",
            "CPF\/CNPJ": "10"
        },
        {
            "id": null,
            "Nome\/Razão social": "Lavada Pfeffer",
            "CPF\/CNPJ": "1"
        }
    ]
}
```

### HTTP Request
`GET clientes`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `paginate` |  optional  | Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false.

<!-- END_83555366ce3e1201a2e2a6bfc33a0b90 -->

#Nota Fiscal


<!-- START_e5d1375c0547c3270d6e28699ab33aa1 -->
## Enviar

Envia dados para api de emissão de nota fiscal

Required dos campos podem variar conforme o valor da finalidade

Nos campos obrigatórios pela finalidade possuem em sua descrição &#039;*&#039; seguido pelo valor da finalidade onde é obrigatório

Valores das finalidades:

1 : NF-e normal

2 : NF-e complementar
2.1 : Preço e/ou quantidade
2.2 : Imposto Complementar

3 : NF-e de ajuste

4 : Devolução/Retorno

5 : Carta de Correção

6 : Inutilizar Numeração

Mais infos: https://webmaniabr.com/docs/rest-api-nfe/

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/nota-fiscal/enviar',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'json' => [
            'operacao' => [
                'ambiente' => 'ratione',
                'operacao' => 'consequatur',
                'natureza_operacao' => 'magni',
                'modelo' => 'quos',
                'finalidade' => 'eligendi',
                'nfe_complementar' => 'omnis',
                'nfe_referenciada' => 'aliquid',
                'codigo_cfop' => 'assumenda',
                'valor_icms' => 'eius',
                'classe_imposto' => 'ea',
                'chave' => 'reiciendis',
                'correcao' => 'non',
            ],
            'cliente' => [
                'tipo_pessoa' => 'eos',
                'nome_completo' => 'dolor',
                'cpf_cnpj' => 'nulla',
                'razao_social' => 'minima',
                'ie' => 'reprehenderit',
                'suframa' => 'soluta',
                'substituto_tributario' => 'aut',
                'consumidor_final' => 'aliquam',
                'contribuinte' => 'velit',
                'endereco' => 'vero',
                'complemento' => 'nesciunt',
                'numero' => 'provident',
                'bairro' => 'at',
                'cidade' => 'quod',
                'uf' => 'error',
                'cep' => 'qui',
                'telefone' => 'nisi',
                'email' => 'voluptas',
            ],
            'produtos' => [
                [
                    'item' => 'tenetur',
                    'nome' => 'velit',
                    'codigo' => 'culpa',
                    'ncm' => 'earum',
                    'cest' => 'architecto',
                    'quantidade' => 'fuga',
                    'unidade' => 'cumque',
                    'peso' => 'expedita',
                    'origem' => 'vel',
                    'desconto' => 'soluta',
                    'subtotal' => 'dolores',
                    'total' => 'consequatur',
                    'tributos_federais' => 'porro',
                    'tributos_estaduais' => 'veritatis',
                    'codigo_cfop' => 'magnam',
                    'impostos' => [
                        'icms' => [
                            'situacao_tributaria' => 'dolorum',
                            'tipo_tributacao' => 'beatae',
                            'aliquota_credito' => 'sed',
                            'aliquota_mva' => 'est',
                            'aliquota_importacao' => 'commodi',
                            'aliquota_reducao_st' => 'sapiente',
                            'bc_st_retido' => 'hic',
                            'aliquota_st_retido' => 'qui',
                            'valor_st_retido' => 'consectetur',
                            'valor_fcp_retido' => 'repudiandae',
                            'aliquota_fcp_retido' => 'dolorem',
                            'icms_efetivo' => 'optio',
                            'industria' => 'quos',
                        ],
                        'ipi' => [
                            'situacao_tributaria' => 'cumque',
                            'codigo_enquadramento' => 'occaecati',
                            'aliquota' => 'nobis',
                        ],
                        'pis' => [
                            'situacao_tributaria' => 'commodi',
                            'aliquota' => 'aut',
                        ],
                        'cofins' => [
                            'situacao_tributaria' => 'et',
                            'aliquota' => 'dolor',
                        ],
                    ],
                ],
            ],
            'quantidade' => [],
            'impostos' => [
                'bc_icms' => 'ad',
                'valor_icms' => 'eos',
                'bc_icms_st' => 'animi',
                'valor_icms_st' => 'doloremque',
                'aliquota_mva' => 'molestias',
                'bc_ipi' => 'dolores',
                'valor_ipi' => 'aut',
            ],
            'transporte' => [
                'peso_bruto' => 'ipsa',
                'peso_liquido' => 'dolores',
                'volume' => 'dolorum',
                'especie' => 'necessitatibus',
                'marca' => 'laborum',
                'numeracao' => 'maxime',
                'lacres' => 'commodi',
                'uf' => 'non',
                'razao_social' => 'sed',
                'cnpj' => 'numquam',
                'ie' => 'perferendis',
                'cep' => 'modi',
                'endereco' => 'optio',
                'cidade' => 'ratione',
                'placa' => 'officia',
                'uf_veiculo' => 'assumenda',
                'rntc' => 'tempore',
                'seguro' => 'ipsum',
                'reboque_placa' => 'quidem',
                'reboque_uf_veiculo' => 'quia',
                'reboque_rntc' => 'sed',
                'vagao' => 'ut',
                'balsa' => 'id',
            ],
            'pedido' => [
                [
                    'pagamento' => [
                        [
                            'forma_pagamento' => 'officiis',
                            'pagamento' => 'autem',
                            'valor_pagamento' => 'reprehenderit',
                            'bandeira' => 'perferendis',
                            'cnpj_credenciadora' => 'eveniet',
                            'autorizacao' => 'voluptatibus',
                        ],
                    ],
                    'fatura' => [
                        'numero' => 'dolor',
                        'valor' => 'eaque',
                        'valor_liquido' => 'id',
                        'desconto' => 'quam',
                    ],
                    'parcelas' => [
                        [
                            'vencimento' => 'et',
                            'valor' => 'architecto',
                        ],
                    ],
                ],
            ],
            'frete' => 'suscipit',
            'desconto' => 'ut',
            'despesas_acessorias' => 'aut',
            'total' => 'fugit',
            'modalidade_frete' => 'aut',
            'ID' => 'ut',
            'data_entrada_saida' => 'aut',
            'presenca' => 'iste',
            'informacoes_complementares' => 'eaque',
            'informacoes_fisco' => 'necessitatibus',
            'volume' => 'laborum',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/enviar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

let body = {
    "operacao": {
        "ambiente": "ratione",
        "operacao": "consequatur",
        "natureza_operacao": "magni",
        "modelo": "quos",
        "finalidade": "eligendi",
        "nfe_complementar": "omnis",
        "nfe_referenciada": "aliquid",
        "codigo_cfop": "assumenda",
        "valor_icms": "eius",
        "classe_imposto": "ea",
        "chave": "reiciendis",
        "correcao": "non"
    },
    "cliente": {
        "tipo_pessoa": "eos",
        "nome_completo": "dolor",
        "cpf_cnpj": "nulla",
        "razao_social": "minima",
        "ie": "reprehenderit",
        "suframa": "soluta",
        "substituto_tributario": "aut",
        "consumidor_final": "aliquam",
        "contribuinte": "velit",
        "endereco": "vero",
        "complemento": "nesciunt",
        "numero": "provident",
        "bairro": "at",
        "cidade": "quod",
        "uf": "error",
        "cep": "qui",
        "telefone": "nisi",
        "email": "voluptas"
    },
    "produtos": [
        {
            "item": "tenetur",
            "nome": "velit",
            "codigo": "culpa",
            "ncm": "earum",
            "cest": "architecto",
            "quantidade": "fuga",
            "unidade": "cumque",
            "peso": "expedita",
            "origem": "vel",
            "desconto": "soluta",
            "subtotal": "dolores",
            "total": "consequatur",
            "tributos_federais": "porro",
            "tributos_estaduais": "veritatis",
            "codigo_cfop": "magnam",
            "impostos": {
                "icms": {
                    "situacao_tributaria": "dolorum",
                    "tipo_tributacao": "beatae",
                    "aliquota_credito": "sed",
                    "aliquota_mva": "est",
                    "aliquota_importacao": "commodi",
                    "aliquota_reducao_st": "sapiente",
                    "bc_st_retido": "hic",
                    "aliquota_st_retido": "qui",
                    "valor_st_retido": "consectetur",
                    "valor_fcp_retido": "repudiandae",
                    "aliquota_fcp_retido": "dolorem",
                    "icms_efetivo": "optio",
                    "industria": "quos"
                },
                "ipi": {
                    "situacao_tributaria": "cumque",
                    "codigo_enquadramento": "occaecati",
                    "aliquota": "nobis"
                },
                "pis": {
                    "situacao_tributaria": "commodi",
                    "aliquota": "aut"
                },
                "cofins": {
                    "situacao_tributaria": "et",
                    "aliquota": "dolor"
                }
            }
        }
    ],
    "quantidade": [],
    "impostos": {
        "bc_icms": "ad",
        "valor_icms": "eos",
        "bc_icms_st": "animi",
        "valor_icms_st": "doloremque",
        "aliquota_mva": "molestias",
        "bc_ipi": "dolores",
        "valor_ipi": "aut"
    },
    "transporte": {
        "peso_bruto": "ipsa",
        "peso_liquido": "dolores",
        "volume": "dolorum",
        "especie": "necessitatibus",
        "marca": "laborum",
        "numeracao": "maxime",
        "lacres": "commodi",
        "uf": "non",
        "razao_social": "sed",
        "cnpj": "numquam",
        "ie": "perferendis",
        "cep": "modi",
        "endereco": "optio",
        "cidade": "ratione",
        "placa": "officia",
        "uf_veiculo": "assumenda",
        "rntc": "tempore",
        "seguro": "ipsum",
        "reboque_placa": "quidem",
        "reboque_uf_veiculo": "quia",
        "reboque_rntc": "sed",
        "vagao": "ut",
        "balsa": "id"
    },
    "pedido": [
        {
            "pagamento": [
                {
                    "forma_pagamento": "officiis",
                    "pagamento": "autem",
                    "valor_pagamento": "reprehenderit",
                    "bandeira": "perferendis",
                    "cnpj_credenciadora": "eveniet",
                    "autorizacao": "voluptatibus"
                }
            ],
            "fatura": {
                "numero": "dolor",
                "valor": "eaque",
                "valor_liquido": "id",
                "desconto": "quam"
            },
            "parcelas": [
                {
                    "vencimento": "et",
                    "valor": "architecto"
                }
            ]
        }
    ],
    "frete": "suscipit",
    "desconto": "ut",
    "despesas_acessorias": "aut",
    "total": "fugit",
    "modalidade_frete": "aut",
    "ID": "ut",
    "data_entrada_saida": "aut",
    "presenca": "iste",
    "informacoes_complementares": "eaque",
    "informacoes_fisco": "necessitatibus",
    "volume": "laborum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST nota-fiscal/enviar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `operacao` | array |  required  | 
        `operacao.ambiente` | string |  optional  | *1, 2, 3
        `operacao.operacao` | string |  optional  | *1, 2, 3
        `operacao.natureza_operacao` | string |  optional  | *1, 2, 3
        `operacao.modelo` | string |  optional  | *1
        `operacao.finalidade` | string |  required  | 1 : NF-e normal, 2 : NF-e complementar, 3 : NF-e de ajuste, 4 : Devolução/Retorno, 5 : Carta de Correção, 6 : Inutilizar Numeração
        `operacao.nfe_complementar` | string |  optional  | *2
        `operacao.nfe_referenciada` | string |  optional  | *2 Chave de acesso da NF-e emitida anteriormente, 4: Chave de acesso da NF-e emitida anteriormente
        `operacao.codigo_cfop` | string |  optional  | *3, 4: Para Notas Fiscais emitidas com Impostos via API: Código CFOP de devolução
        `operacao.valor_icms` | string |  optional  | *3
        `operacao.classe_imposto` | string |  optional  | *4 Para Notas Fiscais emitidas com Classe de Imposto: Classe de imposto de devolução.
        `operacao.chave` | string |  optional  | *5 Chave de acesso da NF-e
        `operacao.correcao` | string |  optional  | *5 Justificativa da correção
        `cliente` | object |  optional  | *1, 2, 3
        `cliente.tipo_pessoa` | string |  optional  | 
        `cliente.nome_completo` | string |  optional  | *Pessoa Física
        `cliente.cpf_cnpj` | string |  optional  | 
        `cliente.razao_social` | string |  optional  | 
        `cliente.ie` | string |  optional  | *Caso isento deve trazer o valor 0 (zero)
        `cliente.suframa` | string |  optional  | *Pessoa Jurídica
        `cliente.substituto_tributario` | string |  optional  | 
        `cliente.consumidor_final` | string |  optional  | 
        `cliente.contribuinte` | string |  optional  | 
        `cliente.endereco` | string |  required  | 
        `cliente.complemento` | string |  optional  | 
        `cliente.numero` | string |  required  | 
        `cliente.bairro` | string |  required  | 
        `cliente.cidade` | string |  required  | 
        `cliente.uf` | string |  required  | 
        `cliente.cep` | string |  required  | 
        `cliente.telefone` | string |  optional  | 
        `cliente.email` | string |  optional  | 
        `produtos` | array |  optional  | 4: Obrigatório para devolução parcial: Número sequencial dos produtos Para a devolução parcial dos produtos é necessário informar quais produtos serão devolvidos, indique por ordem sequencial. Por exemplo, caso os produtos devolvidos sejam o segundo e o terceiro da nota fiscal indique o número 2 e 3 na array.
        `produtos.*` | object |  optional  | 
        `produtos.*.item` | string |  optional  | 
        `produtos.*.nome` | string |  required  | 
        `produtos.*.codigo` | string |  required  | Código do produto (Tag cProd do XML)
        `produtos.*.ncm` | string |  required  | 
        `produtos.*.cest` | string |  optional  | *Identificado automaticamente de acordo com o NCM. Caso seja identificado mais de um código CEST para o mesmo NCM será obrigatório informar o código correto.
        `produtos.*.quantidade` | string |  optional  | *1 required, 2.1: Obrigatório para complementar quantidade: Quantidade de itens
        `produtos.*.unidade` | string |  required  | 
        `produtos.*.peso` | string |  optional  | *Caso não seja informado o peso do produto é obrigatório informar o Peso Bruto e Peso Líquido dentro da array transporte.
        `produtos.*.origem` | string |  required  | 
        `produtos.*.desconto` | string |  optional  | 
        `produtos.*.subtotal` | string |  optional  | *1 required, 2.1: Obrigatório para complementar preço: Preço unitário do produto
        `produtos.*.total` | string |  optional  | *1 required, 2.1: Obrigatório para complementar preço: Preço total (quantidade x preço unitário)
        `produtos.*.tributos_federais` | string |  optional  | 
        `produtos.*.tributos_estaduais` | string |  optional  | 
        `produtos.*.codigo_cfop` | *1 |  optional  | Código Fiscal de Operações e Prestações (CFOP), 2 Código Fiscal de Operações e Prestações (CFOP) Informar o código CFOP da operação do ICMS complementar
        `produtos.*.impostos` | object |  optional  | 
        `produtos.*.impostos.icms` | object |  required  | 
        `produtos.*.impostos.icms.situacao_tributaria` | string |  optional  | *1 Código da situação tributária, 2.1 Código da situação tributária Informar a situação tributária da operação do ICMS complementar, 2.2 Obrigatório para complementar ICMS e ICMS-ST: Código da situação tributária Informar a situação tributária da operação do ICMS complementar
        `produtos.*.impostos.icms.tipo_tributacao` | string |  optional  | 
        `produtos.*.impostos.icms.aliquota_credito` | string |  optional  | 
        `produtos.*.impostos.icms.aliquota_mva` | string |  optional  | 
        `produtos.*.impostos.icms.aliquota_importacao` | string |  optional  | 
        `produtos.*.impostos.icms.aliquota_reducao_st` | string |  optional  | 
        `produtos.*.impostos.icms.bc_st_retido` | string |  optional  | 
        `produtos.*.impostos.icms.aliquota_st_retido` | string |  optional  | 
        `produtos.*.impostos.icms.valor_st_retido` | string |  optional  | 
        `produtos.*.impostos.icms.valor_fcp_retido` | string |  optional  | 
        `produtos.*.impostos.icms.aliquota_fcp_retido` | string |  optional  | 
        `produtos.*.impostos.icms.icms_efetivo` | string |  optional  | 
        `produtos.*.impostos.icms.industria` | string |  optional  | 
        `produtos.*.impostos.ipi` | object |  required  | 
        `produtos.*.impostos.ipi.situacao_tributaria` | string |  required  | 
        `produtos.*.impostos.ipi.codigo_enquadramento` | string |  required  | 
        `produtos.*.impostos.ipi.aliquota` | string |  required  | 
        `produtos.*.impostos.pis` | object |  required  | 
        `produtos.*.impostos.pis.situacao_tributaria` | string |  required  | 
        `produtos.*.impostos.pis.aliquota` | string |  required  | 
        `produtos.*.impostos.cofins` | object |  required  | 
        `produtos.*.impostos.cofins.situacao_tributaria` | string |  required  | 
        `produtos.*.impostos.cofins.aliquota` | string |  required  | 
        `quantidade` | array |  optional  | 4: Opcional para devolução parcial: Número da quantidade de unidades devolvidas na devolução parcial. Indique na ordem correspondente da array produtos.
        `impostos` | string |  optional  | *2.2 Obrigatório para complementar ICMS: Base de cálculo do complemento do ICMS
        `impostos.bc_icms` | string |  optional  | *2.2 Obrigatório para complementar ICMS: Base de cálculo do complemento do ICMS
        `impostos.valor_icms` | string |  optional  | *2.2 Obrigatório para complementar ICMS: Valor do complemento do ICMS
        `impostos.bc_icms_st` | string |  optional  | *2.2 Obrigatório para complementar ICMS-ST: Base de cálculo do complemento do ICMS-ST
        `impostos.valor_icms_st` | string |  optional  | *2.2 Obrigatório para complementar ICMS-ST: Valor do complemento do ICMS-ST
        `impostos.aliquota_mva` | string |  optional  | *2.2 Obrigatório para complementar ICMS-ST: Percentual da Margem de Valor Agregado Original (MVA/IVA)
        `impostos.bc_ipi` | string |  optional  | *2.2 Obrigatório para complementar IPI: Base de cálculo do complemento do IPI
        `impostos.valor_ipi` | string |  optional  | *2.2 Obrigatório para complementar IPI: Valor do complemento do IPI
        `transporte` | array |  required  | 
        `transporte.peso_bruto` | string |  optional  | 
        `transporte.peso_liquido` | string |  optional  | 
        `transporte.volume` | string |  optional  | 
        `transporte.especie` | string |  optional  | 
        `transporte.marca` | string |  optional  | 
        `transporte.numeracao` | string |  optional  | 
        `transporte.lacres` | string |  optional  | 
        `transporte.uf` | string |  optional  | A UF deve ser informada se informado uma IE. Informar "EX" para Exterior.
        `transporte.razao_social` | string |  optional  | 
        `transporte.cnpj` | string |  optional  | 
        `transporte.ie` | string |  optional  | 0 - Isento ou Nº da Inscrição Estadual
        `transporte.cep` | string |  optional  | 
        `transporte.endereco` | string |  optional  | 
        `transporte.cidade` | string |  optional  | 
        `transporte.placa` | string |  optional  | Informar em um dos seguintes formatos: XXX9999, XXX999, XX9999 ou XXXX999.
        `transporte.uf_veiculo` | string |  optional  | 
        `transporte.rntc` | string |  optional  | Registro Nacional de Transportador de Carga (ANTT)
        `transporte.seguro` | string |  optional  | 
        `transporte.reboque_placa` | string |  optional  | 
        `transporte.reboque_uf_veiculo` | string |  optional  | 
        `transporte.reboque_rntc` | string |  optional  | 
        `transporte.vagao` | string |  optional  | 
        `transporte.balsa` | string |  optional  | 
        `pedido` | array |  required  | 
        `pedido.*.pagamento` | array |  required  | 
        `pedido.*.pagamento.*.forma_pagamento` | string |  optional  | 
        `pedido.*.pagamento.*.pagamento` | string |  optional  | 
        `pedido.*.pagamento.*.valor_pagamento` | string |  optional  | 
        `pedido.*.pagamento.*.bandeira` | string |  optional  | 
        `pedido.*.pagamento.*.cnpj_credenciadora` | string |  optional  | 
        `pedido.*.pagamento.*.autorizacao` | string |  optional  | 
        `pedido.*.fatura` | array |  required  | 
        `pedido.*.fatura.numero` | string |  required  | 
        `pedido.*.fatura.valor` | string |  required  | 
        `pedido.*.fatura.valor_liquido` | string |  required  | 
        `pedido.*.fatura.desconto` | string |  required  | 
        `pedido.*.parcelas` | array |  required  | 
        `pedido.*.parcelas.*.vencimento` | string |  required  | 
        `pedido.*.parcelas.*.valor` | string |  required  | 
        `frete` | string |  required  | Para nota fiscal de importação não inserir o valor do frete. Podendo ser informado o valor somente no campo Informações ao Fisco.
        `desconto` | string |  required  | 
        `despesas_acessorias` | string |  optional  | 
        `total` | string |  optional  | 
        `modalidade_frete` | string |  required  | 
        `ID` | string |  optional  | Número do pedido de compra por produto. (Tag xPed do XML)
        `data_entrada_saida` | string |  optional  | 
        `presenca` | string |  required  | 
        `informacoes_complementares` | string |  optional  | 
        `informacoes_fisco` | string |  optional  | 
        `volume` | string |  optional  | 4: Quantidade de volumes transportados
    
<!-- END_e5d1375c0547c3270d6e28699ab33aa1 -->

<!-- START_b9ba3496ef8f970454637409da2f10e8 -->
## Cancelar

Envia dados para api de cancelamento de nota fiscal

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/nota-fiscal/cancelar',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'json' => [
            'chave' => 'quam',
            'motivo' => 'provident',
            'operacao' => [
                'ambiente' => 'aspernatur',
                'modelo' => 'tempora',
                'finalidade' => 'odio',
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/cancelar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

let body = {
    "chave": "quam",
    "motivo": "provident",
    "operacao": {
        "ambiente": "aspernatur",
        "modelo": "tempora",
        "finalidade": "odio"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST nota-fiscal/cancelar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `chave` | string |  required  | Chave de acesso da NF-e
        `motivo` | string |  required  | Justificativa do cancelamento
        `operacao` | array |  required  | 
        `operacao.ambiente` | string |  required  | 
        `operacao.modelo` | string |  required  | 
        `operacao.finalidade` | string |  required  | 
    
<!-- END_b9ba3496ef8f970454637409da2f10e8 -->

<!-- START_3fcdc732255fc49b642bc970744628e3 -->
## Carta de correção (CC-e)

A Carta de Correção Eletrônica (CC-e) é um evento legal e tem por objetivo corrigir algumas informações da NF-e que já foi emitida.

O que NÃO é permitido corrigir com a carta de correção?

- Valores como base de cálculo, alíquota, diferença de preço e quantidade.

- Dados cadastrais que implique mudança do remetente ou do destinatário.

- A data de emissão ou de saída.

- Série e número da nota fiscal.

A sua alteração não se enquadra na carta de correção?

Emita uma nota fiscal de devolução para anular os efeitos fiscais da NF-e emitida anteriormente, logo após emita uma nova nota fiscal normalmente.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/nota-fiscal/carta-correcao',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'json' => [
            'carta_correcao' => [
                'chave' => 'sit',
                'correcao' => 'et',
            ],
            'operacao' => [
                'ambiente' => 'consequatur',
                'modelo' => 'pariatur',
                'finalidade' => 'ducimus',
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/carta-correcao"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

let body = {
    "carta_correcao": {
        "chave": "sit",
        "correcao": "et"
    },
    "operacao": {
        "ambiente": "consequatur",
        "modelo": "pariatur",
        "finalidade": "ducimus"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST nota-fiscal/carta-correcao`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `carta_correcao` | array |  required  | 
        `carta_correcao.chave` | string |  required  | Chave de acesso da NF-e
        `carta_correcao.correcao` | string |  required  | Justificativa da correção
        `operacao` | array |  required  | 
        `operacao.ambiente` | string |  required  | 
        `operacao.modelo` | string |  required  | 
        `operacao.finalidade` | string |  required  | 
    
<!-- END_3fcdc732255fc49b642bc970744628e3 -->

<!-- START_756b04ca9126c8996dffd379df5c57af -->
## Inutilizar numeração

Inutilizar uma sequência de numeração de Nota Fiscal

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/nota-fiscal/inutilizar-numeracao',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'json' => [
            'sequencia' => 'repellendus',
            'motivo' => 'eaque',
            'ambiente' => 'et',
            'serie' => 'debitis',
            'modelo' => 'saepe',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/inutilizar-numeracao"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

let body = {
    "sequencia": "repellendus",
    "motivo": "eaque",
    "ambiente": "et",
    "serie": "debitis",
    "modelo": "saepe"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST nota-fiscal/inutilizar-numeracao`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `sequencia` | string |  required  | Sequência da numeração
        `motivo` | string |  required  | Justificativa da inutilização
        `ambiente` | string |  required  | Identificação do Ambiente do Sefaz
        `serie` | string |  required  | Série da numeração
        `modelo` | string |  required  | Modelo da numeração
    
<!-- END_756b04ca9126c8996dffd379df5c57af -->

#Produto


<!-- START_1e63d2d3072e67a0d19a1fb773c5ae60 -->
## Salvar/Editar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Salva um novo produto ou sobrescreve os dados de um produto já existente

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/produto/salvar',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'json' => [
            'id' => 1,
            'nome' => 'sint',
            'codigo' => 'ut',
            'ean' => 'voluptates',
            'ncm' => 'nostrum',
            'cest' => 'rerum',
            'quantidade' => 'architecto',
            'unidade' => 'culpa',
            'origem' => 'ex',
            'subtotal' => 'veniam',
            'total' => 'exercitationem',
            'impostos' => [
                'icms' => [
                    'codigo_cfop' => 'tempore',
                    'situacao_tributaria' => 'maiores',
                    'tipo_tributacao' => 'doloribus',
                    'aliquota_credito' => 'perspiciatis',
                    'aliquota_mva' => 'neque',
                    'aliquota_importacao' => 'quia',
                    'aliquota_reducao_st' => 'earum',
                    'bc_st_retido' => 'aut',
                    'aliquota_st_retido' => 'et',
                    'valor_st_retido' => 'ipsam',
                    'valor_fcp_retido' => 'alias',
                    'aliquota_fcp_retido' => 'similique',
                    'icms_efetivo' => 'ea',
                    'industria' => 'vitae',
                ],
                'ipi' => [
                    'situacao_tributaria' => 'dolorum',
                    'codigo_enquadramento' => 'voluptatem',
                    'aliquota' => 'adipisci',
                ],
                'pis' => [
                    'situacao_tributaria' => 'sequi',
                    'aliquota' => 'perspiciatis',
                ],
                'cofins' => [
                    'situacao_tributaria' => 'distinctio',
                    'aliquota' => 'sed',
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/produto/salvar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

let body = {
    "id": 1,
    "nome": "sint",
    "codigo": "ut",
    "ean": "voluptates",
    "ncm": "nostrum",
    "cest": "rerum",
    "quantidade": "architecto",
    "unidade": "culpa",
    "origem": "ex",
    "subtotal": "veniam",
    "total": "exercitationem",
    "impostos": {
        "icms": {
            "codigo_cfop": "tempore",
            "situacao_tributaria": "maiores",
            "tipo_tributacao": "doloribus",
            "aliquota_credito": "perspiciatis",
            "aliquota_mva": "neque",
            "aliquota_importacao": "quia",
            "aliquota_reducao_st": "earum",
            "bc_st_retido": "aut",
            "aliquota_st_retido": "et",
            "valor_st_retido": "ipsam",
            "valor_fcp_retido": "alias",
            "aliquota_fcp_retido": "similique",
            "icms_efetivo": "ea",
            "industria": "vitae"
        },
        "ipi": {
            "situacao_tributaria": "dolorum",
            "codigo_enquadramento": "voluptatem",
            "aliquota": "adipisci"
        },
        "pis": {
            "situacao_tributaria": "sequi",
            "aliquota": "perspiciatis"
        },
        "cofins": {
            "situacao_tributaria": "distinctio",
            "aliquota": "sed"
        }
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST produto/salvar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  optional  | Informar no caso de edição de dados de um produto
        `nome` | string |  required  | 
        `codigo` | string |  required  | 
        `ean` | string |  optional  | 
        `ncm` | string |  optional  | 
        `cest` | string |  optional  | 
        `quantidade` | string |  optional  | 
        `unidade` | string |  optional  | 
        `origem` | string |  optional  | 
        `subtotal` | string |  optional  | 
        `total` | string |  optional  | 
        `impostos` | object |  optional  | 
        `impostos.icms` | object |  required  | 
        `impostos.icms.codigo_cfop` | string |  required  | Código Fiscal de Operações e Prestações (CFOP)
        `impostos.icms.situacao_tributaria` | string |  required  | Código da situação tributária
        `impostos.icms.tipo_tributacao` | required |  optional  | string
        `impostos.icms.aliquota_credito` | string |  optional  | 
        `impostos.icms.aliquota_mva` | string |  optional  | 
        `impostos.icms.aliquota_importacao` | string |  optional  | 
        `impostos.icms.aliquota_reducao_st` | string |  optional  | 
        `impostos.icms.bc_st_retido` | string |  optional  | 
        `impostos.icms.aliquota_st_retido` | string |  optional  | 
        `impostos.icms.valor_st_retido` | string |  optional  | 
        `impostos.icms.valor_fcp_retido` | string |  optional  | 
        `impostos.icms.aliquota_fcp_retido` | string |  optional  | 
        `impostos.icms.icms_efetivo` | string |  optional  | 
        `impostos.icms.industria` | string |  optional  | 
        `impostos.ipi` | object |  required  | 
        `impostos.ipi.situacao_tributaria` | string |  required  | 
        `impostos.ipi.codigo_enquadramento` | string |  required  | 
        `impostos.ipi.aliquota` | string |  required  | 
        `impostos.pis` | object |  required  | 
        `impostos.pis.situacao_tributaria` | string |  required  | 
        `impostos.pis.aliquota` | string |  required  | 
        `impostos.cofins` | object |  required  | 
        `impostos.cofins.situacao_tributaria` | string |  required  | 
        `impostos.cofins.aliquota` | string |  required  | 
    
<!-- END_1e63d2d3072e67a0d19a1fb773c5ae60 -->

<!-- START_e6b7463e9839deb52108af08376eee01 -->
## Produto

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Retorna um objeto contendo dados de um produto cadastrado

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/produto/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/produto/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "item": null,
            "nome": "Alice watched the.",
            "codigo": null,
            "ncm": "12345678",
            "quantidade": null,
            "unidade": null,
            "peso": null,
            "origem": 1,
            "desconto": null,
            "subtotal": 82,
            "total": null,
            "classe_imposto": null,
            "veiculo_usado": null,
            "ind_escala": null,
            "cnpj_fabricante": null,
            "beneficio_fiscal": null,
            "gtin": null,
            "gtin_tributavel": null,
            "cest": null,
            "nve": null,
            "nrecopi": null,
            "informacoes_adicionais": null,
            "ativo_permanente": null,
            "tributos_federais": null,
            "impostos": {
                "icms": {
                    "codigo_cfop": "6910",
                    "tipo_tributacao": "normal",
                    "situacao_tributaria": "40",
                    "aliquota_credito": null,
                    "aliquota_reducao": null,
                    "aliquota_mva": null,
                    "aliquota_diferimento": null,
                    "aliquota_importacao": null,
                    "aliquota_reducao_st": null,
                    "motivo_desoneracao": null,
                    "bc_st_retido": null,
                    "aliquota_st_retido": null,
                    "valor_st_retido": null,
                    "valor_fcp_retido": null,
                    "aliquota_fcp_retido": null,
                    "industria": null
                },
                "ipi": {
                    "situacao_tributaria": "99",
                    "codigo_enquadramento": "999",
                    "aliquota": 0,
                    "codigo_selo": null,
                    "qtd_selo": null
                },
                "pis": {
                    "situacao_tributaria": "99",
                    "aliquota": 0
                },
                "cofins": {
                    "situacao_tributaria": "99",
                    "aliquota": 0
                },
                "estimativa": {
                    "tributos_federais": null,
                    "tributos_estaduais": null
                }
            }
        },
        {
            "id": null,
            "item": null,
            "nome": "Mock Turtle.",
            "codigo": null,
            "ncm": "12345678",
            "quantidade": null,
            "unidade": null,
            "peso": null,
            "origem": 1,
            "desconto": null,
            "subtotal": 66,
            "total": null,
            "classe_imposto": null,
            "veiculo_usado": null,
            "ind_escala": null,
            "cnpj_fabricante": null,
            "beneficio_fiscal": null,
            "gtin": null,
            "gtin_tributavel": null,
            "cest": null,
            "nve": null,
            "nrecopi": null,
            "informacoes_adicionais": null,
            "ativo_permanente": null,
            "tributos_federais": null,
            "impostos": {
                "icms": {
                    "codigo_cfop": "6910",
                    "tipo_tributacao": "normal",
                    "situacao_tributaria": "40",
                    "aliquota_credito": null,
                    "aliquota_reducao": null,
                    "aliquota_mva": null,
                    "aliquota_diferimento": null,
                    "aliquota_importacao": null,
                    "aliquota_reducao_st": null,
                    "motivo_desoneracao": null,
                    "bc_st_retido": null,
                    "aliquota_st_retido": null,
                    "valor_st_retido": null,
                    "valor_fcp_retido": null,
                    "aliquota_fcp_retido": null,
                    "industria": null
                },
                "ipi": {
                    "situacao_tributaria": "99",
                    "codigo_enquadramento": "999",
                    "aliquota": 0,
                    "codigo_selo": null,
                    "qtd_selo": null
                },
                "pis": {
                    "situacao_tributaria": "99",
                    "aliquota": 0
                },
                "cofins": {
                    "situacao_tributaria": "99",
                    "aliquota": 0
                },
                "estimativa": {
                    "tributos_federais": null,
                    "tributos_estaduais": null
                }
            }
        }
    ]
}
```

### HTTP Request
`GET produto/{produto}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `produto` |  optional  | Id do produto

<!-- END_e6b7463e9839deb52108af08376eee01 -->

<!-- START_4e657a9114213d599d16d21f99a8a84f -->
## Produtos

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Retorna um objeto contendo dados dos produtos cadastrados

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/produtos',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
        'query' => [
            'paginate' => '0',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/produtos"
);

let params = {
    "paginate": "0",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": null,
            "Nome": "SHE, of course,'.",
            "Código": null,
            "NCM": "12345678",
            "Valor": 36
        },
        {
            "id": null,
            "Nome": "And he added.",
            "Código": null,
            "NCM": "12345678",
            "Valor": 57
        }
    ]
}
```

### HTTP Request
`GET produtos`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `paginate` |  optional  | Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false.

<!-- END_4e657a9114213d599d16d21f99a8a84f -->

#general


<!-- START_c6c5c00d6ac7f771f157dff4a2889b1a -->
## _debugbar/open
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/_debugbar/open',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/_debugbar/open"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/open`


<!-- END_c6c5c00d6ac7f771f157dff4a2889b1a -->

<!-- START_7b167949c615f4a7e7b673f8d5fdaf59 -->
## Return Clockwork output

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/_debugbar/clockwork/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/_debugbar/clockwork/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/clockwork/{id}`


<!-- END_7b167949c615f4a7e7b673f8d5fdaf59 -->

<!-- START_01a252c50bd17b20340dbc5a91cea4b7 -->
## _debugbar/telescope/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/_debugbar/telescope/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/_debugbar/telescope/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/telescope/{id}`


<!-- END_01a252c50bd17b20340dbc5a91cea4b7 -->

<!-- START_5f8a640000f5db43332951f0d77378c4 -->
## Return the stylesheets for the Debugbar

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/_debugbar/assets/stylesheets',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/_debugbar/assets/stylesheets"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/assets/stylesheets`


<!-- END_5f8a640000f5db43332951f0d77378c4 -->

<!-- START_db7a887cf930ce3c638a8708fd1a75ee -->
## Return the javascript for the Debugbar

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/_debugbar/assets/javascript',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/_debugbar/assets/javascript"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET _debugbar/assets/javascript`


<!-- END_db7a887cf930ce3c638a8708fd1a75ee -->

<!-- START_0973671c4f56e7409202dc85c868d442 -->
## Forget a cache key

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://nfc.gestor/_debugbar/cache/1/',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/_debugbar/cache/1/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE _debugbar/cache/{key}/{tags?}`


<!-- END_0973671c4f56e7409202dc85c868d442 -->

<!-- START_f7b7ea397f8939c8bb93e6cab64603ce -->
## Display Swagger API page.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/api/documentation',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/api/documentation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/documentation`


<!-- END_f7b7ea397f8939c8bb93e6cab64603ce -->

<!-- START_1ead214f30a5e235e7140eb2aaa29eee -->
## Dump api-docs content endpoint. Supports dumping a json, or yaml file.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/docs/',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/docs/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "swagger": "2.0",
    "info": {
        "title": "Gestor API",
        "version": "1.0.0"
    },
    "basePath": "\/",
    "paths": {
        "\/clientes": {
            "get": {
                "tags": [
                    "Clientes"
                ],
                "summary": "Lista de de clientes cadastrados",
                "parameters": [
                    {
                        "name": "paginate",
                        "in": "query",
                        "description": "Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false",
                        "required": false,
                        "type": "boolean"
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    },
                    "500": {
                        "description": "Internal Server Error"
                    }
                },
                "security": [
                    {
                        "Bearer": []
                    }
                ]
            }
        },
        "\/cliente\/{cliente}": {
            "get": {
                "tags": [
                    "Clientes"
                ],
                "summary": "Dados do cliente",
                "parameters": [
                    {
                        "name": "cliente",
                        "in": "path",
                        "description": "Id do cliente",
                        "required": true,
                        "type": "integer"
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    },
                    "500": {
                        "description": "Internal Server Error"
                    }
                },
                "security": [
                    {
                        "Bearer": []
                    }
                ]
            }
        },
        "\/cliente\/salvar": {
            "post": {
                "tags": [
                    "Clientes"
                ],
                "summary": "Salvar dados do cliente",
                "parameters": [
                    {
                        "name": "body",
                        "in": "body",
                        "description": "Dados do cliente",
                        "required": true,
                        "schema": {
                            "required": [
                                "tipo_pessoa",
                                "nome_completo",
                                "cpf_cnpj",
                                "cep",
                                "endereco",
                                "numero",
                                "bairro",
                                "cidade",
                                "uf",
                                "email",
                                "telefone"
                            ],
                            "properties": {
                                "tipo_pessoa": {
                                    "type": "string"
                                },
                                "nome_completo": {
                                    "type": "string"
                                },
                                "cpf_cnpj": {
                                    "type": "string"
                                },
                                "consumidor_final": {
                                    "type": "string"
                                },
                                "cep": {
                                    "type": "string"
                                },
                                "endereco": {
                                    "type": "string"
                                },
                                "numero": {
                                    "type": "string"
                                },
                                "complemento": {
                                    "type": "string"
                                },
                                "bairro": {
                                    "type": "string"
                                },
                                "cidade": {
                                    "type": "string"
                                },
                                "uf": {
                                    "type": "string"
                                },
                                "email": {
                                    "type": "string"
                                },
                                "telefone": {
                                    "type": "string"
                                }
                            },
                            "type": "object"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    },
                    "500": {
                        "description": "Internal Server Error"
                    }
                },
                "security": [
                    {
                        "Bearer": []
                    }
                ]
            }
        },
        "\/nota-fiscal\/enviar": {
            "post": {
                "tags": [
                    "Nota-fiscal"
                ],
                "summary": "Enviar nota fiscal para api",
                "parameters": [
                    {
                        "name": "body",
                        "in": "body",
                        "description": "Dados para envio da nota fiscal",
                        "required": true,
                        "schema": {
                            "required": [
                                "nome",
                                "codigo"
                            ],
                            "properties": {
                                "operacao": {
                                    "type": "string"
                                },
                                "natureza_operacao": {
                                    "type": "string"
                                },
                                "modelo": {
                                    "type": "string"
                                },
                                "finalidade": {
                                    "type": "string"
                                },
                                "ambiente": {
                                    "type": "string"
                                },
                                "cliente": {
                                    "properties": {
                                        "cpf": {
                                            "type": "string"
                                        },
                                        "nome_completo": {
                                            "type": "string"
                                        },
                                        "cnpj": {
                                            "type": "string"
                                        },
                                        "razao_social": {
                                            "type": "string"
                                        },
                                        "ie": {
                                            "type": "string"
                                        },
                                        "suframa": {
                                            "type": "string"
                                        },
                                        "substituto_tributario": {
                                            "type": "string"
                                        },
                                        "consumidor_final": {
                                            "type": "string"
                                        },
                                        "contribuinte": {
                                            "type": "string"
                                        },
                                        "endereco": {
                                            "type": "string"
                                        },
                                        "complemento": {
                                            "type": "string"
                                        },
                                        "numero": {
                                            "type": "string"
                                        },
                                        "bairro": {
                                            "type": "string"
                                        },
                                        "cidade": {
                                            "type": "string"
                                        },
                                        "uf": {
                                            "type": "string"
                                        },
                                        "cep": {
                                            "type": "string"
                                        },
                                        "telefone": {
                                            "type": "string"
                                        },
                                        "email": {
                                            "type": "string"
                                        },
                                        "produtos": {
                                            "type": "string"
                                        },
                                        "pedido": {
                                            "type": "string"
                                        },
                                        "transporte": {
                                            "type": "string"
                                        }
                                    },
                                    "type": "object"
                                },
                                "produtos": {
                                    "description": "Um array contendo multiplos objetos de cada produto",
                                    "type": "array",
                                    "items": {
                                        "properties": {
                                            "item": {
                                                "type": "string"
                                            },
                                            "nome": {
                                                "type": "string"
                                            },
                                            "codigo": {
                                                "type": "string"
                                            },
                                            "ncm": {
                                                "type": "string"
                                            },
                                            "cest": {
                                                "type": "string"
                                            },
                                            "quantidade": {
                                                "type": "string"
                                            },
                                            "unidade": {
                                                "type": "string"
                                            },
                                            "peso": {
                                                "type": "string"
                                            },
                                            "origem": {
                                                "type": "string"
                                            },
                                            "desconto": {
                                                "type": "string"
                                            },
                                            "subtotal": {
                                                "type": "string"
                                            },
                                            "total": {
                                                "type": "string"
                                            },
                                            "tributos_federais": {
                                                "type": "string"
                                            },
                                            "tributos_estaduais": {
                                                "type": "string"
                                            },
                                            "impostos": {
                                                "properties": {
                                                    "icms": {
                                                        "properties": {
                                                            "codigo_cfop": {
                                                                "type": "string"
                                                            },
                                                            "situacao_tributaria": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_reducao": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_credito": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_mva": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_diferimento": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_importacao": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_reducao_st": {
                                                                "type": "string"
                                                            },
                                                            "motivo_desoneracao": {
                                                                "type": "string"
                                                            },
                                                            "bc_st_retido": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_st_retido": {
                                                                "type": "string"
                                                            },
                                                            "valor_st_retido": {
                                                                "type": "string"
                                                            },
                                                            "valor_fcp_retido": {
                                                                "type": "string"
                                                            },
                                                            "aliquota_fcp_retido": {
                                                                "type": "string"
                                                            },
                                                            "icms_efetivo": {
                                                                "type": "string"
                                                            },
                                                            "industria": {
                                                                "type": "string"
                                                            }
                                                        },
                                                        "type": "object"
                                                    },
                                                    "ipi": {
                                                        "properties": {
                                                            "situacao_tributaria": {
                                                                "type": "string"
                                                            },
                                                            "codigo_enquadramento": {
                                                                "type": "string"
                                                            },
                                                            "aliquota": {
                                                                "type": "string"
                                                            },
                                                            "codigo_selo": {
                                                                "type": "string"
                                                            },
                                                            "qtd_selo": {
                                                                "type": "string"
                                                            }
                                                        },
                                                        "type": "object"
                                                    },
                                                    "pis": {
                                                        "properties": {
                                                            "situacao_tributaria": {
                                                                "type": "string"
                                                            },
                                                            "aliquota": {
                                                                "type": "string"
                                                            }
                                                        },
                                                        "type": "object"
                                                    },
                                                    "cofins": {
                                                        "properties": {
                                                            "situacao_tributaria": {
                                                                "type": "string"
                                                            },
                                                            "aliquota": {
                                                                "type": "string"
                                                            }
                                                        },
                                                        "type": "object"
                                                    }
                                                },
                                                "type": "object"
                                            }
                                        },
                                        "type": "object"
                                    }
                                },
                                "pedido": {
                                    "properties": {
                                        "presenca": {
                                            "type": "string"
                                        },
                                        "modalidade_frete": {
                                            "type": "string"
                                        },
                                        "frete": {
                                            "type": "string"
                                        },
                                        "desconto": {
                                            "type": "string"
                                        },
                                        "total": {
                                            "type": "string"
                                        },
                                        "despesas_acessorias": {
                                            "type": "string"
                                        },
                                        "despesas_aduaneiras": {
                                            "type": "string"
                                        },
                                        "informacoes_fisco": {
                                            "type": "string"
                                        },
                                        "informacoes_complementares": {
                                            "type": "string"
                                        },
                                        "observacoes_contribuinte": {
                                            "type": "string"
                                        }
                                    },
                                    "type": "object"
                                },
                                "transporte": {
                                    "properties": {
                                        "volume": {
                                            "type": "string"
                                        },
                                        "especie": {
                                            "type": "string"
                                        },
                                        "peso_bruto": {
                                            "type": "string"
                                        },
                                        "peso_liquido": {
                                            "type": "string"
                                        },
                                        "marca": {
                                            "type": "string"
                                        },
                                        "numeracao": {
                                            "type": "string"
                                        },
                                        "lacres": {
                                            "type": "string"
                                        },
                                        "cnpj": {
                                            "type": "string"
                                        },
                                        "razao_social": {
                                            "type": "string"
                                        },
                                        "ie": {
                                            "type": "string"
                                        },
                                        "cpf": {
                                            "type": "string"
                                        },
                                        "nome_completo": {
                                            "type": "string"
                                        },
                                        "endereco": {
                                            "type": "string"
                                        },
                                        "uf": {
                                            "type": "string"
                                        },
                                        "cidade": {
                                            "type": "string"
                                        },
                                        "cep": {
                                            "type": "string"
                                        },
                                        "placa": {
                                            "type": "string"
                                        },
                                        "uf_veiculo": {
                                            "type": "string"
                                        },
                                        "rntc": {
                                            "type": "string"
                                        },
                                        "seguro": {
                                            "type": "string"
                                        },
                                        "reboque_placa": {
                                            "type": "string"
                                        },
                                        "reboque_uf_veiculo": {
                                            "type": "string"
                                        },
                                        "reboque_rntc": {
                                            "type": "string"
                                        },
                                        "vagao": {
                                            "type": "string"
                                        },
                                        "balsa": {
                                            "type": "string"
                                        }
                                    },
                                    "type": "object"
                                }
                            },
                            "type": "object"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    }
                }
            }
        },
        "\/produtos": {
            "get": {
                "tags": [
                    "Produtos"
                ],
                "summary": "Lista de de produtos cadastrados",
                "parameters": [
                    {
                        "name": "paginate",
                        "in": "query",
                        "description": "Indica se o retorno vem sem páginação, para isso o parâmetro deve receber o valor 0 ou false",
                        "required": false,
                        "type": "boolean"
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    }
                }
            }
        },
        "\/produto\/{produto}": {
            "get": {
                "tags": [
                    "Produtos"
                ],
                "summary": "Dados do produto",
                "parameters": [
                    {
                        "name": "produto",
                        "in": "path",
                        "description": "Id do produto",
                        "required": true,
                        "type": "integer"
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    }
                }
            }
        },
        "\/produto\/salvar": {
            "post": {
                "tags": [
                    "Produtos"
                ],
                "summary": "Salvar dados do produto",
                "parameters": [
                    {
                        "name": "body",
                        "in": "body",
                        "description": "Dados do produto",
                        "required": true,
                        "schema": {
                            "required": [
                                "nome",
                                "codigo"
                            ],
                            "properties": {
                                "nome": {
                                    "type": "string"
                                },
                                "codigo": {
                                    "type": "string"
                                },
                                "ean": {
                                    "type": "string"
                                },
                                "ncm": {
                                    "type": "string"
                                },
                                "cest": {
                                    "type": "string"
                                },
                                "quantidade": {
                                    "type": "string"
                                },
                                "unidade": {
                                    "type": "string"
                                },
                                "origem": {
                                    "type": "string"
                                },
                                "subtotal": {
                                    "type": "string"
                                },
                                "total": {
                                    "type": "string"
                                },
                                "impostos": {
                                    "required": [
                                        "icms",
                                        "ipi",
                                        "pis",
                                        "cofins"
                                    ],
                                    "properties": {
                                        "icms": {
                                            "required": [
                                                "codigo_cfop",
                                                "situacao_tributaria",
                                                "tipo_tributacao"
                                            ],
                                            "properties": {
                                                "codigo_cfop": {
                                                    "description": "Código Fiscal de Operações e Prestações (CFOP)",
                                                    "type": "string"
                                                },
                                                "situacao_tributaria": {
                                                    "description": "Código da situação tributária",
                                                    "type": "string"
                                                },
                                                "tipo_tributacao": {
                                                    "type": "string"
                                                },
                                                "aliquota_credito": {
                                                    "type": "string"
                                                },
                                                "aliquota_mva": {
                                                    "type": "string"
                                                },
                                                "aliquota_importacao": {
                                                    "type": "string"
                                                },
                                                "aliquota_reducao_st": {
                                                    "type": "string"
                                                },
                                                "bc_st_retido": {
                                                    "type": "string"
                                                },
                                                "aliquota_st_retido": {
                                                    "type": "string"
                                                },
                                                "valor_st_retido": {
                                                    "type": "string"
                                                },
                                                "valor_fcp_retido": {
                                                    "type": "string"
                                                },
                                                "aliquota_fcp_retido": {
                                                    "type": "string"
                                                },
                                                "icms_efetivo": {
                                                    "type": "string"
                                                },
                                                "industria": {
                                                    "type": "string"
                                                }
                                            },
                                            "type": "object"
                                        },
                                        "ipi": {
                                            "required": [
                                                "situacao_tributaria",
                                                "codigo_enquadramento",
                                                "aliquota"
                                            ],
                                            "properties": {
                                                "situacao_tributaria": {
                                                    "type": "string"
                                                },
                                                "codigo_enquadramento": {
                                                    "type": "string"
                                                },
                                                "aliquota": {
                                                    "type": "string"
                                                }
                                            },
                                            "type": "object"
                                        },
                                        "pis": {
                                            "required": [
                                                "situacao_tributaria",
                                                "aliquota"
                                            ],
                                            "properties": {
                                                "situacao_tributaria": {
                                                    "type": "string"
                                                },
                                                "aliquota": {
                                                    "type": "string"
                                                }
                                            },
                                            "type": "object"
                                        },
                                        "cofins": {
                                            "required": [
                                                "situacao_tributaria",
                                                "aliquota"
                                            ],
                                            "properties": {
                                                "situacao_tributaria": {
                                                    "type": "string"
                                                },
                                                "aliquota": {
                                                    "type": "string"
                                                }
                                            },
                                            "type": "object"
                                        }
                                    },
                                    "type": "object"
                                }
                            },
                            "type": "object"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Successful operation"
                    },
                    "400": {
                        "description": "Bad request"
                    },
                    "404": {
                        "description": "Resource Not Found"
                    }
                }
            }
        }
    },
    "definitions": {}
}
```

### HTTP Request
`GET docs/{jsonFile?}`

`POST docs/{jsonFile?}`

`PUT docs/{jsonFile?}`

`PATCH docs/{jsonFile?}`

`DELETE docs/{jsonFile?}`

`OPTIONS docs/{jsonFile?}`


<!-- END_1ead214f30a5e235e7140eb2aaa29eee -->

<!-- START_1a23c1337818a4de9e417863aebaca33 -->
## docs/asset/{asset}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/docs/asset/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/docs/asset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "(1) - this L5 Swagger asset is not allowed"
}
```

### HTTP Request
`GET docs/asset/{asset}`


<!-- END_1a23c1337818a4de9e417863aebaca33 -->

<!-- START_a2c4ea37605c6d2e3c93b7269030af0a -->
## Display Oauth2 callback pages.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/api/oauth2-callback',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/api/oauth2-callback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET api/oauth2-callback`


<!-- END_a2c4ea37605c6d2e3c93b7269030af0a -->

<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/oauth/authorize',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/oauth/authorize',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://nfc.gestor/oauth/authorize',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/oauth/token',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/oauth/tokens',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://nfc.gestor/oauth/tokens/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/oauth/token/refresh',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/token/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/oauth/clients',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/oauth/clients',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://nfc.gestor/oauth/clients/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://nfc.gestor/oauth/clients/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/oauth/scopes',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/scopes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/oauth/personal-access-tokens',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/oauth/personal-access-tokens',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://nfc.gestor/oauth/personal-access-tokens/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/login',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/register',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_4cfa6012631d8390b1d1c7905df4e44b -->
## details api

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/details',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/details"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST details`


<!-- END_4cfa6012631d8390b1d1c7905df4e44b -->

<!-- START_7f147e7f6f70e6c0eb216aa513d8c4a9 -->
## get/estados
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/get/estados',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/get/estados"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET get/estados`


<!-- END_7f147e7f6f70e6c0eb216aa513d8c4a9 -->

<!-- START_9ad9d1f4d82101168e9a1def625f2bb6 -->
## get/paises
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/get/paises',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/get/paises"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET get/paises`


<!-- END_9ad9d1f4d82101168e9a1def625f2bb6 -->

<!-- START_c0dbf7eb1a9de357ddbfb55177c777d4 -->
## opcoes/form-icms
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-icms',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-icms"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-icms`


<!-- END_c0dbf7eb1a9de357ddbfb55177c777d4 -->

<!-- START_cff1c30990bf9b2c7e571b304ccb7f18 -->
## opcoes/form-ipi
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-ipi',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-ipi"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-ipi`


<!-- END_cff1c30990bf9b2c7e571b304ccb7f18 -->

<!-- START_fadb5b2cc85994233dbbec6434709716 -->
## opcoes/form-pis
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-pis',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-pis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-pis`


<!-- END_fadb5b2cc85994233dbbec6434709716 -->

<!-- START_f610b2e3296175c49b6cc7d87d615756 -->
## opcoes/form-cofins
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-cofins',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-cofins"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-cofins`


<!-- END_f610b2e3296175c49b6cc7d87d615756 -->

<!-- START_f9a0e1d9f4c1e46f5bc2d8f8e4b9b968 -->
## opcoes/form-importacao
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-importacao',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-importacao"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-importacao`


<!-- END_f9a0e1d9f4c1e46f5bc2d8f8e4b9b968 -->

<!-- START_9fe211e53636246847bd8636f2add5c6 -->
## opcoes/form-exportacao
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-exportacao',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-exportacao"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-exportacao`


<!-- END_9fe211e53636246847bd8636f2add5c6 -->

<!-- START_aff392a8ef438058594d35df358e64a0 -->
## opcoes/form-detalhamento
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/form-detalhamento',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/form-detalhamento"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/form-detalhamento`


<!-- END_aff392a8ef438058594d35df358e64a0 -->

<!-- START_9e5fd5fb133ff1a9dbaef5ba4750206c -->
## opcoes/forms-impostos
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/opcoes/forms-impostos',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/opcoes/forms-impostos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET opcoes/forms-impostos`


<!-- END_9e5fd5fb133ff1a9dbaef5ba4750206c -->

<!-- START_328ffa809bf66b4120fe4f831281d29c -->
## nota-fiscal/notas
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/nota-fiscal/notas',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/notas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET nota-fiscal/notas`


<!-- END_328ffa809bf66b4120fe4f831281d29c -->

<!-- START_7af508397c98b6cb0ad1b3644dbe6c06 -->
## nota-fiscal/devolucao
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/nota-fiscal/devolucao',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/devolucao"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST nota-fiscal/devolucao`


<!-- END_7af508397c98b6cb0ad1b3644dbe6c06 -->

<!-- START_4925af295e5bca6ee703a5c2686833d0 -->
## nota-fiscal/nota
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/nota-fiscal/nota',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/nota-fiscal/nota"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET nota-fiscal/nota`


<!-- END_4925af295e5bca6ee703a5c2686833d0 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/login',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/logout',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/register',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/password/reset',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/password/email',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/password/reset/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/password/reset',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/password/confirm',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://nfc.gestor/password/confirm',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
## Show the application dashboard.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/home',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/home"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET home`


<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->

<!-- START_2ecd2c34871333ab0f1e6108147335fc -->
## {any}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://nfc.gestor/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "http://nfc.gestor/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer ",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET {any}`


<!-- END_2ecd2c34871333ab0f1e6108147335fc -->


