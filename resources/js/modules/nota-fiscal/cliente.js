const cliente = {

    state: {
        cliente: {},
        clientes: {},
        loading: false
    },
    
    getters: {
        getCliente: state => {
            return state.cliente
        },
        getLoading: state => {
            return state.cliente
        },
    },
    
    mutations: {
        SET_PRODUTO (state, produto) {
            state.produto = produto
        },
        SET_LOADING (state, loading) {
            state.loading = loading
        },
        SET_CLIENTES(state, clientes) {
            state.clientes = clientes
        },
        SET_CLIENTE(state, cliente) {
            state.cliente = cliente
        }
    },
    
    actions: {
        async getCliente({commit}, id) {
            commit('SET_LOADING', true)
            const response = await axios.get('/cliente/'+id)
            commit('SET_CLIENTE', response.data)
            commit('SET_LOADING', false)

            return response.data
        },
        async getClientes({commit}, params = "") {
            commit('SET_LOADING', true)
            const response = await axios.get('/clientes'+params)
            commit('SET_CLIENTES', response.data)
            commit('SET_LOADING', false)
        },
    }

}

export default cliente;
