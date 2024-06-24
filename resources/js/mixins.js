Vue.mixin({
    methods: {
        isEmptyObject(object){
            if(typeof object == 'object') {
                return Object.keys(object).length === 0
            }
            return false
        },
        isEmpty(value){
            if(typeof value == 'object') {
                return Object.keys(value).length === 0
            } 
            return value !== null && value !== undefined
        },
        cleanObserver(object) {
            return JSON.parse(JSON.stringify(object))
        },
        array_contains(array, valor) {
            return array.indexOf(valor) >= 0
        },
        floatval(valor) {
            if(typeof valor == 'string') {
                return parseFloat(valor.replace(',', '.'))
            } else {
                return $(valor).text().replace(',', '.')
            }
        },
        scrollTop() {
            document.body.scrollTop = document.documentElement.scrollTop = 0;
        },
        dateBR(valor, formato = null) {
            let ts = new Date(valor)
            return ts.toLocaleDateString()
        },
        formataCnpjCpf(value)
        {
            const cnpjCpf = value.replace(/\D/g, '');
            
            if (cnpjCpf.length === 11) {
                return cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
            } 
            
            return cnpjCpf.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
        },
        ObjectLength( object ) {
            return Object.keys(object).length;
        },
        random() {
           return Math.floor(Math.random() * 100);
        },
        fianlidadeNota(finalidade) {
            switch(finalidade) {
                case 1: 
                    return 'NF-e normal'
                case 2: 
                    return 'NF-e complementar'
                case 3: 
                    return 'NF-e de ajuste'
                case 4: 
                    return 'Devolução/Retorno'
                case 5: 
                    return 'Carta de Correção'
                case 6: 
                    return 'Inutilizar Numeração'
                default:
                    return ''
            }
        },
    }
})