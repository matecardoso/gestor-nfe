import Vue from 'vue';

const defaultState = () => {
    return {
        errors: {
            operacao: {},
            cliente: {},
            produtos: {},
            transporte: {},
            pedido: {},
            impostos: {},
            carta_correcao: {}
        },
        operacao: {
            'ambiente': 2,
            'modelo': 1
        },
        lista_produtos: {},
        produtos: { 0 : {'impostos' : {
            'icms': {
                'codigo_cfop': ''
            }
        }} },
        chave: 0,
        nota: {},
        cliente: {},
        transporte: {},
        pedido: {
            'pedido': {},
            'pagamento': { 0 : {} },
            'fatura': {},
            'parcelas': { 0 : {} }
        },
        cartaCorrecao: {},
        total: 0,
        loading: false,
        linhaNovaSelecao: false,
        linha: false,
        modalTributos: true,
        impostos: {},
        notas: {},
        configuracoes: {},
        notaDevolucao: false,
        formKey: 0,
        emissao: null,
        showTabImportacao: false
    }
}

const notaFiscal = {

    state: defaultState(),
    
    getters: {
        produto: state => id => {
            return state.produtos[id]
        },
        fields: state => (finalidade = null) => {
            if(finalidade == 5) {
                return {
                    'operacao': state.operacao,
                    'carta_correcao': state.cartaCorrecao
                }
            }
            return {
                'operacao': state.operacao,
                'cliente': state.cliente,
                'produtos': state.produtos,
                'transporte': state.transporte,
                'pedido': state.pedido,
                'impostos': state.impostos
            }
        }
    },
    
    mutations: {
        SET_NOTA_FISCAL(state, nota) {
            // state.operacao = nota.operacao
            state.cliente = nota.cliente
            state.produtos = nota.produtos
            state.transporte = nota.transporte
            state.pedido = nota.pedido            
            state.impostos = nota.impostos

            state.notaDevolucao = true
        },
        SET_INDICE_PRODUTO (state, indice) {
            state.produtos[indice] = {}
        },
        SET_PRODUTO (state, produto) {
            Vue.set(state.produtos, produto['chave'], produto['produto'])
            // state.produtos[produto['chave']] = produto['produto']
        },
        REMOVE_PRODUTO (state, chave) {
            Vue.delete(state.produtos, chave)
        },
        SET_PRODUTO_CAMPO (state, params) {
            state.produtos[params['chave']][params['campo']] = params['valor']
        },
        SET_PRODUTO_BY_ID (state, produto) {
            Vue.set(state.produtos, produto['id'], produto)
            // state.produtos[produto['id']] = produto
        },
        SET_LISTA_PRODUTOS (state, lista_produtos) {
            state.lista_produtos = lista_produtos
        },
        SET_LOADING (state, loading) {
            state.loading = loading
        },
        SET_CHAVE_PRODUTO (state, chave) {
            state.chave = chave
        },
        SET_LINHA_NOVA_SELECAO (state, linhaNovaSelecao) {
            state.linhaNovaSelecao = linhaNovaSelecao
        },
        SET_LINHA (state, linha) {
            state.linha = linha
        },
        SET_MODAL_TRIBUTOS (state, modalTributos) {
            state.modalTributos = modalTributos
        },
        RESET_STATE: function(state) {
            Object.assign(state, defaultState())
        },
        SET_PEDIDO_CAMPO(state, campo, valor) {
            Vue.set(state.pedido, campo, valor)
        },
        SUBTRAI_TOTAL(state, total) {
            state.total = state.total - total
        },
        SOMA_TOTAL(state, total) {
            state.total = state.total + total
        },
        SET_NOTAS_FISCAIS(state, notas) {
            state.notas = notas
        },
        SET_DADOS_NOTA(state, nota) {
            state.nota = nota
        },
        SET_FORM_KEY(state) {
            state.formKey++
        },
        SET_ERRORS_FORM(state, errors) {   
            let temProdutos = false
            let temFormasPagamento = false
            Object.entries(errors).forEach(([key, value]) => {
                let keySplit = key.split(".")
                if(keySplit[0] == 'pedido') {
                    if(keySplit[1] == 'modalidade_frete') {
                        Vue.set(state.errors['transporte'], keySplit[1], value)
                    } else if(keySplit[1] == 'presenca') {
                        Vue.set(state.errors[keySplit[0]], keySplit[1], value)
                    } else if(keySplit[1] == 'pagamento') {
                        if(!temFormasPagamento) {
                            let content = {}
                            content[keySplit[1]] = {}
                            content[keySplit[1]][keySplit[2]] = {}
                            Vue.set(content[keySplit[1]][keySplit[2]], keySplit[3], value)
                            state.errors[keySplit[0]] = content
                            temFormasPagamento = true
                        } else {
                            if(!state.errors[keySplit[0]][keySplit[1]].hasOwnProperty(keySplit[2])) {
                                state.errors[keySplit[0]][keySplit[1]][keySplit[2]] = {}
                            }
                            Vue.set(state.errors[keySplit[0]][keySplit[1]][keySplit[2]], keySplit[3], value)
                        }
                    }
                } else if(keySplit[0] == 'produtos') {
                    if(!temProdutos) {
                        let content = {}
                        content[keySplit[2]] = value
                        Vue.set(state.errors[keySplit[0]], keySplit[1], content)
                        temProdutos = true
                    } else {
                        Vue.set(state.errors[keySplit[0]][keySplit[1]], keySplit[2], value)
                    }
                } else {
                    Vue.set(state.errors[keySplit[0]], keySplit[1], value)
                }
            });
        },
        LIMPA_ERRORS_FORM(state) {
            state.errors = defaultState().errors
        },
        SET_EMISSAO(state, emissao) {
            state.emissao = emissao
        },
        SET_TAB_IMPORTACAO(state, showTabImportacao) {
            state.showTabImportacao = showTabImportacao
        }
    },
    
    actions: {
        async getNotasFiscais({commit}, page = 1) {
            commit('SET_LOADING', true)
            const response = await axios.get('nota-fiscal/notas?page='+page)
            commit('SET_NOTAS_FISCAIS', response.data)
            commit('SET_LOADING', false)
        },
        async getOpcoesSelectProduto({commit}) {
            commit('SET_LOADING', true)
            const response = await axios.get('/produtos?paginate=0&select=1')
            commit('SET_LISTA_PRODUTOS', response.data.data)
            commit('SET_LOADING', false)
        },
        async getProduto({commit}, params) {
            commit('SET_LOADING', true)
            const response = await axios.get('/produto/'+params['id'])
            var produto = {
                'produto' : response.data.data,
                'chave': params['chave']
            }
            commit('SET_PRODUTO', produto)
            commit('SET_LOADING', false)
            commit('SET_LINHA_NOVA_SELECAO', false)
        },
        resetState ({ commit }) {
            commit('RESET_STATE')
            commit('SET_FORM_KEY')
        },
    }

}

export default notaFiscal;
