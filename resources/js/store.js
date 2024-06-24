import Vue from 'vue'
import Vuex from 'vuex'

import moduloSelectOptions from './modules/selectOptions'
import cliente from './modules/nota-fiscal/cliente'
import notaFiscal from './modules/nota-fiscal/notaFiscal'
import configuracoes from './modules/nota-fiscal/configuracoes'

Vue.use(Vuex)

const state = {
    form_emissao: {},
    form_emissao_enviar: false,

    loading: false,
    produto: {}
}

const getters = {
    
}

const mutations = {
    SET_FORM_EMISSAO (state, form_emissao) {
        if(form_emissao) {
            state.old_form_emissao = state.form_emissao
            state.form_emissao = form_emissao
        } else {
            state.form_emissao = state.old_form_emissao
        }
    },
    SET_LOADING (state, loading) {
        state.loading = loading
    }
}

const actions = {
    
}

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions,
    modules: {
        options: moduloSelectOptions,
        nota: notaFiscal,
        cliente: cliente,
        configuracoes: configuracoes
    }
})