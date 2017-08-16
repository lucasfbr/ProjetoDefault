module.exports = {

    ordenar (e, coluna)
    {

        e.preventDefault();

        this.coluna = coluna;
        this.ordenacao = this.ordenacao * -1;
    }

}
