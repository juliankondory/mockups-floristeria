
$('.btn-editar').on('click', function () {
    var id_cliente = $(this).val();
    getDataCliente(id_cliente);
    $('#updateCliente').modal('show');
});

function getDataCliente(id_cliente) {
    $.post("../../php/routing/Admin.php", {
        "getCliente": true,
        "id_cliente": id_cliente
    }).done(function (data) {
        var result = JSON.parse(data);
        getInfoCliente(result);
    });
}

function getInfoCliente(result) {
    $('.id_cliente').val(result[0]);
    $('#nombre').val(result[3]);
    $('#identificacion').val(result[4]);
    $('#correo').val(result[5]);
    $('#telefono').val(result[6]);
    $('#departamento').val(result[7]);
    $('#ciudad').val(result[8]);
    $('#estado option[value="' + result[9] + '"]')
        .attr('selected', 'selected')
        .change();
}

$('.btn-eliminar').on('click', function () {
    var id_cliente = $(this).val();
    $('.id_cliente').val(id_cliente);

    $('#deleteCliente').modal('show');

});