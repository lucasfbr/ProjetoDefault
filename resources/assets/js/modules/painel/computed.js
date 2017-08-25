module.exports = {

    validation: function () {

        return {
            empresa: !!this.experiencia.empresa.trim(),
            cargo: !!this.experiencia.cargo.trim(),
            dataEntrada: !!this.experiencia.dataEntrada.trim(),
            dataSaida: !!this.experiencia.dataSaida.trim()
        }

    },

    isValid: function () {

        var validation = this.validation;

        return Object.keys(validation).every(function (key) {
            return validation[key];
        })

    }


}