//FUNCION PARA VER LA CONTRASEÑA
$('#verPass').on('click', function() {
    var tipo = $('#pass').attr('type');
    
    if(tipo == "password"){
        $('#pass').get(0).type="text";
        $("#icon_pass").removeClass("bi bi-eye");
        $("#icon_pass").addClass("bi bi-eye-slash");
    }else{
        $('#pass').get(0).type="password";
        $("#icon_pass").removeClass("bi bi-eye-slash");
        $("#icon_pass").addClass("bi bi-eye");
    }
});

$('#viewPass').on('change', function () {
    if ($("#viewPass").is(':checked')) {
        $('#newPass').get(0).type = "text";
        $('#confirmPass').get(0).type = "text";
    } else {
        $('#newPass').get(0).type = "password";
        $('#confirmPass').get(0).type = "password";

    }
});

$('#viewPassPerfil').on('change', function () {
    if ($("#viewPassPerfil").is(':checked')) {
        $('#pass').get(0).type = "text";
        $('#newPass').get(0).type = "text";
        $('#confirmPass').get(0).type = "text";
    } else {
        $('#pass').get(0).type = "password";
        $('#newPass').get(0).type = "password";
        $('#confirmPass').get(0).type = "password";

    }
});