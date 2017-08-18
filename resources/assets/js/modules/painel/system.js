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



        self.$http.get('/painel/experienciaprofissional/all').then(function (response) {


            for(var prop in response.data){


                self.experienciaLista.push({
                    empresa:response.data[prop].empresa,
                    cargo:response.data[prop].cargo,
                    dataEntrada:response.data[prop].dataEntrada,
                    dataSaida:response.data[prop].dataSaida});


                //console.log(response.data[prop]);


            }

            //console.log(self.experienciaLista);


            /*if(response.data){


                self.experienciaLista.push({
                    empresa:this.experiencia.empresa,
                    cargo:this.experiencia.cargo,
                    dataEntrada:this.experiencia.dataEntrada,
                    dataSaida:this.experiencia.dataSaida});

            }*/

        });

    }
}
