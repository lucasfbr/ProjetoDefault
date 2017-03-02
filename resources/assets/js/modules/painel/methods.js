module.exports = {
    buscar: function () {


        var self = this;

        if(/^[0-9]{5}-[0-9]{3}$/.test(this.cep)){

            jQuery.getJSON('http://viacep.com.br/ws/'+this.cep+'/json/', function (endereco) {

                if(endereco.erro){

                    jQuery(self.$els.estado).focus();
                    self.naoLocalizado = true;
                    return

                }

                self.endereco = endereco;
                jQuery(self.$els.numero).focus();


            });

        }

    }
};