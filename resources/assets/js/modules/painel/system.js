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
    }
}
