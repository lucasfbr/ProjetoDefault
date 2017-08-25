module.exports = {
    buscar: function () {

        var self = this;

        if(/^[0-9]{5}-[0-9]{3}$/.test(this.cep)){

            //console.log(this.cep)

            jQuery.getJSON('http://viacep.com.br/ws/'+this.cep+'/json/', function (endereco) {

                if(endereco.erro){
                    jQuery(self.$els.estado).focus();
                    self.naoLocalizado = true;
                    return
                }
                self.endereco = endereco;
                jQuery(self.$els.numero).val("");
                jQuery(self.$els.numero).focus();
            });
        }
    },
    ordenar: function (e, coluna) {

        var self = this;

        e.preventDefault();

        self.coluna = coluna;
        self.ordenacao = self.ordenacao * -1;

    },
    previous: function (e) {

        e.preventDefault();

        console.log( 'maxpage : ' +this.pagination.maxPage )
        console.log( 'current : ' + this.pagination.current )
        console.log( 'totalItens : ' +this.pagination.totalItens )
        console.log( 'totalPages : ' +this.pagination.totalPages )

        if(this.pagination.current === 1){
            return false;
        }

        this.pagination.current = this.pagination.current - 1;

        this.user = this.pagination.listPagination[this.pagination.current - 1];

    },
    pagePagination: function (e, current) {

        e.preventDefault();

        this.pagination.current = current + 1;

        this.user = this.pagination.listPagination[current];

    },
    next: function (e) {

        e.preventDefault();

        console.log( 'maxpage : ' +this.pagination.maxPage )
        console.log( 'current : ' + this.pagination.current )
        console.log( 'totalItens : ' +this.pagination.totalItens )
        console.log( 'totalPages : ' +this.pagination.totalPages )


        if(this.pagination.current === this.pagination.totalPages){
            return false;
        }

        this.pagination.current = this.pagination.current + 1;

        this.user = this.pagination.listPagination[this.pagination.current - 1];

    },
    totalDigitado: function () {

        this.resumoTotal = parseInt(this.resumoServico.length);

    },
    editarBanner: function (e, id, titulo, descricao, status) {

        e.preventDefault();

        var self = this;

        self.bannerFuncao = 'update/' + id;
        jQuery(self.$els.titulo).val(titulo);
        jQuery(self.$els.titulo).focus();
        jQuery(self.$els.descricao).val(descricao);
        if (status == '1') {
            jQuery(self.$els.checked).prop( "checked", true );
        }
        else {
            jQuery(self.$els.checked).prop( "checked", false );
        }


        self.banerFormulario = true;

    },
    incluirBanner: function (e) {

        e.preventDefault();

        var self = this;

        self.bannerFuncao = 'create';

        jQuery(self.$els.titulo).val("");
        jQuery(self.$els.descricao).val("");
        jQuery(self.$els.checked).prop( "checked", false );

        jQuery(self.$els.titulo).focus();

        self.banerFormulario = true;

    },
    //enviar para a lixeira
    enviarMsgLixeira: function () {

        var self = this;

        if(self.msgCheck == '')
            return false

        var confirmacaoUsuario = confirm('Realmente deseja excluir este registro?');

        if(confirmacaoUsuario) {

            self.$http.get('/painel/mensagem/delete/' + self.msgCheck).then(function (response) {

                if (response.data)
                    location.reload();

            });
        }

    },
    //enviar msg para a lixeira diretamente do read
    readMsgLixeira: function (id) {

        var self = this;

        if(id == '')
            return false


        var confirmacaoUsuario = confirm('Realmente deseja enviar este registro para a lixeira?');

        if(confirmacaoUsuario) {

            self.$http.get('/painel/mensagem/delete/' + id).then(function (response) {

                if (response.data)
                    jQuery(window.document.location).attr('href', '/painel/mensagem');

            });

        }

    },
    //excluir permanentemente a mensagem
    deletarMsg: function () {

        var self = this;

        if(self.msgCheck == '')
            return false

        var confirmacaoUsuario = confirm('Realmente deseja excluir este registro? Ele será removido permanentemente');

        if(confirmacaoUsuario) {

            self.$http.get('/painel/mensagem/trash/destroy/' + self.msgCheck).then(function (response) {

                if (response.data)
                    jQuery(window.document.location).attr('href', '/painel/mensagem/trash');

            });

        }

    },
    //restaurar mensagem para a caixa de entrada
    restaurarMsg: function () {

        var self = this;

        alert(self.msgCheck)

        if(self.msgCheck == '')
            return false

        var confirmacaoUsuario = confirm('Realmente deseja restaurar este registro?');

        if(confirmacaoUsuario) {

            self.$http.get('/painel/mensagem/trash/restore/' + self.msgCheck).then(function (response) {

                if (response.data)
                    jQuery(window.document.location).attr('href', '/painel/mensagem/trash');

            });

        }

    },
    refresh: function () {

        location.reload();

    },

    addExperiencia: function (e) {

        e.preventDefault();

        this.experienciaLista.push({
            id:this.experiencia.id,
            perfil_id:this.experiencia.perfil_id,
            empresa:this.experiencia.empresa,
            cargo:this.experiencia.cargo,
            dataEntrada:this.experiencia.dataEntrada,
            dataSaida:this.experiencia.dataSaida
        });

        this.experiencia.empresa = "";
        this.experiencia.cargo = "";
        this.experiencia.dataEntrada = "";
        this.experiencia.dataSaida = "";

    },
    removeExperiencia: function (e, indice) {

        e.preventDefault();

        if(confirm('Realmente deseja excluir este registro?')) {

            var self = this;
            var id = this.experienciaLista[indice].id;


            if (id) {

                //remove registro do banco
                self.$http.get('/painel/experienciaprofissional/delete/' + id).then(function (response) {


                    //console.log(response.data);

                    if (response.data) {

                        //remove registro do array
                        this.experienciaLista.splice(indice, 1);

                    } else {

                        console.log('Ocorreu algum erro ao deletar o registro');

                    }

                });

            } else {
                //remove 1 posicao do array com indice = ao id
                this.experienciaLista.splice(indice, 1);
            }

        }
        //console.log(this.experienciaLista[indice].id)




    },
    cadExpProfissional: function () {

        //alert('chegou')

        var self = this;
        var dados = this.experienciaLista;

        if(this.experiencia) {

            self.$http.post('/painel/experienciaprofissional/add', dados).then(function (response) {

                //console.log(response.data);

                if (response.data) {

                    document.formPerfil.submit();

                } else {

                    console.log('Erro ao cadastrar as experiencias profissionais')

                }

            });

        }else{

            document.formPerfil.submit();

        }


    }


};