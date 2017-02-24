module.exports = {
    ready: function () {

        var self = this;

        self.$http.get('http://localhost:8000/list').then(function (response) {

            for (var k in response.data) {

                self.user.push(response.data[k]);
            }

        });
    }
}
