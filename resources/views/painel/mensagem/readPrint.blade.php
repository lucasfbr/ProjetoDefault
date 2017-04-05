<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ info_sistem()->titulo != '' ? info_sistem()->titulo : 'Titulo do sistema' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="/css/painel.css">


    <!-- Morris chart -->
    <link rel="stylesheet" href="/assets/painel/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/assets/painel/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/assets/painel/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/assets/painel/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/assets/painel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body onload="window.print();">
<div class="wrapper">
    <section class="invoice">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Mensagem enviada para o site paludoconsultoria.com.br</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-read-info">
                <h3>Assunto: Contato pelo site</h3>
                <h5>De: {{$mensagem->email}}
                    <span class="mailbox-read-time pull-right">{{$mensagem->created_at}}</span></h5>
                <h5>Nome: {{$mensagem->nome}}</h5>
                <h5>Telefone: {{$mensagem->telefone}}</h5>
            </div>
            <!-- /.mailbox-read-info -->

            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
                <p>{{$mensagem->mensagem}}</p>
            </div>
            <!-- /.mailbox-read-message -->
        </div>

    </div>
<!-- /. box -->
    </section>
</div>

</body>
</html>