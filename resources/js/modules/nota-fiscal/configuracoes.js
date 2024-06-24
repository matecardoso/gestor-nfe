const configuracoes = {

    state: {
        unidade: {},
        unidades: {},
        opcoesUnidades: {},
        loading: false
    },
    
    getters: {
        getUnidade: state => {
            return state.unidade
        },
    },
    
    mutations: {
        SET_LOADING (state, loading) {
            state.loading = loading
        },
        SET_UNIDADES(state, unidades) {
            state.unidades = unidades
        },
        SET_OPCOES_UNIDADES(state, opcoesUnidades) {
            state.opcoesUnidades = opcoesUnidades
        },
        SET_UNIDADE(state, unidade) {
            state.unidade = unidade
        }
    },
    
    actions: {
        async getUnidade({commit}, id) {
            commit('SET_LOADING', true)
            const response = await axios.get('conf'+id)
            commit('SET_UNIDADE', response.data)
            commit('SET_LOADING', false)

            return response.data
        },
        async getUnidades({commit}, params = "") {
            commit('SET_LOADING', true)
            const response = await axios.get('configuracao/unidades'+params)
            commit('SET_UNIDADES', response.data)
            commit('SET_LOADING', false)
        },
        async getOpcoesUnidades({commit}) {
            commit('SET_LOADING', true)
            const response = await axios.get('configuracao/unidades?select=1')
            commit('SET_OPCOES_UNIDADES', response.data)
            commit('SET_LOADING', false)
        },
    }

}

export default configuracoes;
