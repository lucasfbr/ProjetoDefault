var moment = require('moment');

module.exports = {

    formatDate: function (value) {

        return moment(value).format('DD/MM/YYYY');

    },


};