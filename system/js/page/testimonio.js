
$('.btn-editar').on('click', function () {
    var id_testimonio = $(this).val();
    getDataTestimonio(id_testimonio);
    $('#updateTestimonio').modal('show');
});

function getDataTestimonio(id_testimonio) {
    $.post("../../php/routing/Admin.php", {
        "getTestimonio": true,
        "id_testimonio": id_testimonio
    }).done(function (data) {
        var result = JSON.parse(data);
        getInfoTestimonio(result);
    });
}

function getInfoTestimonio(result) {
    $('.id_testimonio').val(result[0]);
    $('#nombre').val(result[1]);
    $('#opinion').val(result[3]);
    $('#genero option[value="' + result[2] + '"]')
        .attr('selected', 'selected')
        .change();

    $('#calificacion'+result[4]).prop("checked", true);
}

$('.btn-eliminar').on('click', function () {
    var id_testimonio = $(this).val();
    $('.id_testimonio').val(id_testimonio);

    $('#deleteTestimonio').modal('show');

});