import { 
    estados, 
    paises, 
    origemProduto, 
    opcoesFormIcms, 
    opcoesFormIpi, 
    opcoesFormPis, 
    opcoesFormCofins,
    opcoesFormImportacao,
    opcoesOperacao 
} from '../stores/selectOptions'

const moduloSelectOptions = {

    state: {
        estados: estados(),
        paises: paises(),
        opcoesOrigemProduto: origemProduto(),
        opcoesFormIcms: opcoesFormIcms(),
        opcoesFormIpi: opcoesFormIpi(),
        opcoesFormPis: opcoesFormPis(),
        opcoesFormCofins: opcoesFormCofins(),
        opcoesFormImportacao: opcoesFormImportacao(),
        opcoesOperacao: opcoesOperacao()
    },
    
    getters: {
        
    },
    
    mutations: {
    
    },
    
    actions: {
        
    }

}

export default moduloSelectOptions;
