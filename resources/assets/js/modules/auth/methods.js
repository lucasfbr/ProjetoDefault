module.exports = {

    atualizaTermos: function () {

        if(this.check == true){
            this.check = false;
        }else{
            this.check = true;
        }

        console.log(this.check);

    }

};