module.exports = {
    ready: function () {

        var self = this;

        self.$http.get('/painel/user/list').then(function (response) {

            /*for (var k in response.data) {

                self.user.push(response.data[k]);
            }*/

            //total de itens
            self.pagination.totalItens = response.data.length;
            //total de paginas = totalItens / maxPage e arredondado para cima, ou seja 1,444 = 2
            self.pagination.totalPages = Math.ceil(self.pagination.totalItens / self.pagination.maxPage);

            var aux = [];

            for(var k in response.data){
                aux.push(response.data[k]);

                if(aux.length === self.pagination.maxPage){
                    self.pagination.listPagination.push(aux);

                    aux = [];
                }
            }

            if(aux.length > 0){
                self.pagination.listPagination.push(aux);
            }

            self.user = self.pagination.listPagination[0];

        });



        var url = verificaUrl();
        var idUsuario = url[0];
        var paginaAtual = url[1];

        if(paginaAtual == 'perfil'){


            //alert('estamos na página perfil e o id do usuário é : ' + idUsuario);

            self.$http.get('/painel/experienciaprofissional/find/' + idUsuario).then(function (response) {

                //console.log(response.data);

                for (var prop in response.data) {


                    self.experienciaLista.push({
                        id: response.data[prop].id,
                        perfil_id: response.data[prop].perfil_id,
                        empresa: response.data[prop].empresa,
                        cargo: response.data[prop].cargo,
                        dataEntrada: response.data[prop].data_entrada,
                        dataSaida: response.data[prop].data_saida
                    });

                }

            });



        }

        /*Método responsavel por verificar o id do usuario
        * e confirmar se a url sendo acessada é a página perfil,
        * */
        function verificaUrl() {


            var url = window.location;
            var urlCont;
            var id;
            var perfil;
            var dados = [];

            // converte em String
            url = url.toString()
            // converte em um array separando pelos (/)
            url = url.split("/");
            urlCont = (url.length);

            //id do usuario
            id = url[urlCont -1];
            //pagina atual
            perfil = url[urlCont -2];

            dados.push(id);
            dados.push(perfil);

            return dados;

        }

    }
}
