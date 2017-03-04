<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Matheus Paludo | Consultoria Juridica</title>

    <link href="/css/portal.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body data-spy="scroll" data-target=".menu-navegacao" data-offset="80">

<!-- Menu da aplicacao -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#page-top">Logo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right menu-navegacao" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#page-top"></a></li>
                <li class="active"><a href="/">Home</a></li>
                <li><a href="#servicos">Servicos</a></li>
                <li><a href="#portifolio">Portifolio</a></li>
                <li><a href="#quemsomos">Quem Somos</a></li>
                <li><a href="#localizacao">Localizacao</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href="/login">Login</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- Fim Menu da aplicacao -->

@yield('content')

<!-- footer -->
<footer class="navbar-inverse">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 text-left end-rodape">
                <address>
                    <strong>Matheus Paludo Consultoria Juridica</strong><br>
                    R. São Leopoldo, 429 - Vila Jardim<br>
                    Porto Alegre RS, CEP 91330-690<br>
                    <abbr title="Telefone">Tel:</abbr> (51) 92678620
                </address>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 text-center ">
                <div class="icon-rodape">
                    <div class="col-xs-3">
                        <a href="" title="Facebook" alt="Facebook"><img src="/img/icones/facebook.png"
                                                                        class="img-responsive"></a><br/>
                        <a href="" title="Twitter" alt="Twitter"><img src="/img/icones/twitter.png"
                                                                      class="img-responsive"></a>
                    </div>
                    <div class="col-xs-3">
                        <a href="" title="Youtube" alt="Youtube"><img src="/img/icones/youtube.png"
                                                                      class="img-responsive"></a><br/>
                        <a href="" title="Linkedin" alt="Linkedin"><img src="/img/icones/linkedin.png"
                                                                        class="img-responsive"></a>
                    </div>
                    <div class="col-xs-3">
                        <a href="" title="Skipe" alt="Skipe"><img src="/img/icones/skype.png" class="img-responsive"></a><br/>
                        <a href="" title="Googleplus" alt="Googleplus"><img src="/img/icones/googleplus.png" class="img-responsive"></a>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 text-right rodape-direita">

                <address>
                    Camus | Desenvolvimento Web<br>
                    Site: camusdesenvolvimentoweb.com.br<br>
                    <abbr title="Telefone">Tel:</abbr> (51) 9975-9596
                </address>

            </div>
        </div>
    </div>
</footer>


<script type="text/javascript" src="/js/portal.js"></script>
</body>
</html>