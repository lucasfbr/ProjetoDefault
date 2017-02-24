const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir((mix) => {


    mix.browserify('main.js');

    //js do portal
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.js',
    ], 'public/js/portal.js');

    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.css',
        '../../../node_modules/font-awesome/css/font-awesome.css',
        '../../../node_modules/ionicons/css/ionicons.css',

    ], 'public/css/portal.css');

    //js do auth
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.js',
        '../../../node_modules/html5shiv/dist/html5shiv.js',
        '../../../node_modules/respond.js/src/respond.js',
        '../../../node_modules/icheck/icheck.js',
        'auth/funcoes.js'

    ], 'public/js/auth.js');

    //css do auth
    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.css',
        '../../../node_modules/font-awesome/css/font-awesome.css',
        '../../../node_modules/ionicons/css/ionicons.css',
        'auth/style.css',
        'auth/blue.css',
        'auth/AdminLTE.css',
        'auth/auth.css'

    ], 'public/css/auth.css');

    //js do painel
    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.js',
        '../../../node_modules/jquery-ui-1-11-4/jquery-ui.js',
        '../../../node_modules/raphael/raphael.js',
        '../../../node_modules/morris.js/morris.js',
        '../../../node_modules/sparkline/jquery.sparkline.js',
        '../../../node_modules/jvectormap/jquery-jvectormap-1.2.2.min.js',
        '../../../node_modules/jvectormap/jquery-jvectormap-world-mill-en.js',
        '../../../node_modules/knob/jquery.knob.js',
        '../../../node_modules/moment/moment.js',
        '../../../node_modules/daterangepicker/daterangepicker.js',
        '../../../node_modules/datepicker/bootstrap-datepicker.js',
        '../../../node_modules/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js',
        '../../../node_modules/slimScroll/jquery.slimscroll.min.js',
        '../../../node_modules/fastclick/fastclick.js',
        'painel/app.js',
        'painel/dashboard.js',
        'painel/demo.js',

    ], 'public/js/painel.js');

    //css do painel
    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.css',
        '../../../node_modules/font-awesome/css/font-awesome.css',
        '../../../node_modules/ionicons/css/ionicons.css',
        '../../../node_modules/morris.js/morris.css',
        '../../../node_modules/jvectormap/jquery-jvectormap-1.2.2.css',
        '../../../node_modules/datepicker/datepicker3.css',
        '../../../node_modules/daterangepicker/daterangepicker-bs3.css',
        '../../../node_modules/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'painel/style.css',
        'painel/blue.css',
        'painel/AdminLTE.css',
        'painel/_all-skins.css'

    ], 'public/css/painel.css');

    //pega o conteudo de uma pasta e joga em outra pasta
    //nete caso de node_modules/font-awesome/fonts para /public/fonts/
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

    mix.copy('node_modules/bootstrap/fonts', 'public/fonts');

    mix.copy('node_modules/ionicons/fonts', 'public/fonts');

    /******  COMANDOS QUE DEVEM SER UTILIZADOS PARA O CORRETO FUNCIOANMENTO  *******/

    //gulp              -> executa todas as tarefas acima
    //gulp watch        -> executa todas as tarefas acima e fica monitorando qualquer alteração
    //gulp --production -> compila o arquivo com o minimo de linhas possiveis, deve ser utilizado minutos antes de
    // subir para produção

    /*******************************************************************************/
});
