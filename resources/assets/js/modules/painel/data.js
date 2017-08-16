module.exports = {

    user: [], //array de usuarios
    search: '', //variavel de busca
    filtro: [], //colunas da busca
    ordenacao: '1',
    coluna: 'name',
    cep: '',
    endereco: {}, //enderecos retornados do site http://viacep.com.br/
    naoLocalizado: false, //quando a busca por um cep retornaa um erro
    pagination: {
        maxPage: 6,
        current: 1,
        totalItens: 0,
        totalPages: 0,
        listPagination: []
    },
    resumoServico: '',
    resumoTotal: 0,
    bannerFuncao: 'create',
    banner: {
        titulo : '',
        descricao : '',
        status: ''
    },
    banerFormulario: false,
    msgCheck: [], //check box das mensagens
    experiencia: {
        empresa: '',
        cargo: '',
        dataEntrada: '',
        dataSaida: ''
    },
    experienciaLista:[],



};
