import NotaFiscal from './components/nota-fiscal/NotaFiscal';
import Cliente from './components/nota-fiscal/Cliente';
import Emitir from './components/nota-fiscal/Emitir';
import Produto from './components/nota-fiscal/Produto';
import Configuracao from './components/nota-fiscal/Configuracao';

import PessoaFisica from './components/nota-fiscal/partial/cliente/PessoaFisica';
import PessoaJuridica from './components/nota-fiscal/partial/cliente/PessoaJuridica';
import Estrangeiro from './components/nota-fiscal/partial/cliente/Estrangeiro';

const rotas = [
    {
        path: '/nota-fiscal',
        name: 'nota-fiscal',
        component: NotaFiscal
    },
    {
        path: '/nota-fiscal/cliente',
        name: 'cliente',
        component: Cliente,
        children: [
            {
              path: '/nota-fiscal/cliente/pessoa-fisica',
              name: 'pessoa-fisica',
              component: PessoaFisica
            },
            {
              path: '/nota-fiscal/cliente/pessoa-juridica',
              name: 'pessoa-juridica',
              component: PessoaJuridica
            },
            {
                path: '/nota-fiscal/cliente/estrangeiro',
                name: 'estrangeiro',
                component: Estrangeiro
            }
        ]
    },
    {
        path: '/nota-fiscal/emitir',
        name: 'emitir',
        component: Emitir,
    },
    {
        path: '/nota-fiscal/produto',
        name: 'produto',
        component: Produto,
    },
    {
        path: '/nota-fiscal/configuracao',
        name: 'configuracao',
        component: Configuracao,
    },
];

// {
//     path: '/nota-fiscal/cliente/:title',
//     name: 'cliente',
//     props: true,
//     component: Cliente,
// },

export default rotas;