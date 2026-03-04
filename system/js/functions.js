function validatePassword() {

    var newPass = document.getElementById('newPass');
    var confpass = document.getElementById('confirmPass');

    if (newPass.value == confpass.value) {
        return true;
    } else {
        swal("Las contraseñas no coinciden, intente de nuevo", "", "warning");
        newPass.value = '';
        confpass.value = '';
        return false;
    }
}