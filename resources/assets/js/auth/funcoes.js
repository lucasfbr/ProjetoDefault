$(document).ready(function() {


    $("#btnRegistrar").click(function(e) {

        //paraliza o submit do formulário
        e.preventDefault();

        var tipo   = $("input[name='tipo']:checked").val();
        //var termos = $("#termos");

      /*  if(termos.is(":checked") == false){
            alert('Os termos de contrato devem ser aceitos antes de efetivarmos seu registro!')
            return false;
        }*/

        if(tipo == 1){
            alert('Todo consultor deve ter seu perfil avaliado por nossa equipe. Por isso você deve completar seu cadastro e aguardar nosso contato por e-mail!');
        }

        $("#formularioRegister").submit();

    });

});


$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});


