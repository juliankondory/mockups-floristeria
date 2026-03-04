//FUNCION PARA ELIMINAR EL ESTADO REPETIDO EN LOS USUARIOS
var mycode = {};
$("select[id='estado'] > option").each(function() {
    if (mycode[this.text]) {
        $(this).remove();
    } else {
        mycode[this.text] = this.value;
    }
});