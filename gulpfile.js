const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir((mix) => {

    //arquivos que devem ser inseridos no template, serão todos concatenados e salvos
    //no endereco /public/js/main.js
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.js',

    ], 'public/js/main.js');

    //configuracoes para o vuejs e seus componentes
    //arquivo para desenvolvimento: resource/assets/js/vue.js
    //arquivo para produção: public/js/vue.js
    //este ultimo que deve ser chamado no template
    mix.browserify('vue.js');

    //arquivos que devem ser inseridos no template, serão todos concatenados e salvos
    //no endereco /public/js/main.js
    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.css',
        '../../../node_modules/font-awesome/css/font-awesome.css',
        'style.css'

    ], 'public/css/main.css');

    //arquivos que devem ser inseridos no template, serão todos incluidos
    //no endereco /public/fonts/
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

    /******  COMANDOS QUE DEVEM SER UTILIZADOS PARA O CORRETO FUNCIOANMENTO  *******/

    //gulp              -> executa todas as tarefas acima
    //gulp watch        -> executa todas as tarefas acima e fica monitorando qualquer alteração
    //gulp --production -> compila o arquivo com o minimo de linhas possiveis, deve ser utilizado minutos antes de
    // subir para produção

    /*******************************************************************************/
});
