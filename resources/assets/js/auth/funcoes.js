$(document).ready(function() {


    $("#btnRegistrar").click(function(e) {

        //paraliza o submit do formulário
        e.preventDefault();

        var tipo   = $("input[name='tipo']:checked").val();

        if(tipo == 1){
            alert('Todo consultor deve ter seu perfil avaliado por nossa equipe. Por isso você deve completar seu cadastro e aguardar nosso contato por e-mail!');
        }

        $("#formularioRegister").submit();

    });

});


