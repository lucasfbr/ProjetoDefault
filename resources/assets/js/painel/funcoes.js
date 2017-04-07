$(function () {

    $("#selectall").change(function(){

        if(this.checked){
            $("input[name=lista]").prop('checked', true);
        }else{
            $("input[name=lista]").prop('checked', false);
        }
    });

});
