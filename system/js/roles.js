/**
 * Roles Module - JavaScript AJAX Handler
 * Patrón estandarizado para CRUD operations
 */

const roles = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        const form = $('#roleForm');
        if (form.length) {
            form.on('submit', (e) => {
                e.preventDefault();
                const isEdit = $('#id_rol').val();
                isEdit ? this.update() : this.create();
            });
        }

        // Delete button
        $('#btnDelete').on('click', (e) => {
            e.preventDefault();
            this.delete();
        });
    },

    getFormData: function () {
        return {
            id_rol: $('#id_rol').val() || '',
            nombre: $('input[name="nombre"]').val() || '',
            descripcion: $('textarea[name="descripcion"]').val() || '',
            tipo_legacy: $('select[name="tipo_legacy"]').val() || '',
            activo: $('select[name="activo"]').val() || '1'
        };
    },

    validateForm: function () {
        const form = $('#roleForm')[0];
        form.classList.add('was-validated');

        if (!form.checkValidity()) {
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.focus();

                let errorMessage = 'Por favor completa correctamente todos los campos requeridos.';

                if (firstInvalid.validity.valueMissing) {
                    errorMessage = `El campo "${firstInvalid.previousElementSibling?.textContent || 'requerido'}" es obligatorio.`;
                } else if (firstInvalid.validity.typeMismatch) {
                    errorMessage = 'El formato del campo no es válido.';
                } else if (firstInvalid.validity.patternMismatch) {
                    errorMessage = 'El formato del campo no es válido.';
                }

                swal('Validación', errorMessage, 'warning');
            }
            return false;
        }
        return true;
    },

    create: function () {
        if (!this.validateForm()) {
            return;
        }
        this.sendRequest('newRole', 'Rol registrado exitosamente', 'roles');
    },

    update: function () {
        if (!this.validateForm()) {
            return;
        }
        this.sendRequest('setRole', 'Rol actualizado exitosamente');
    },

    delete: function () {
        const data = this.getFormData();
        if (!data.id_rol) {
            swal('Error', 'Identificador no encontrado', 'error');
            return;
        }

        swal({
            title: '¿Estás seguro?',
            text: '¿Deseas eliminar este rol? Esta acción eliminará permanentemente el rol y sus permisos asociados.',
            icon: 'warning',
            buttons: ['Cancelar', 'Eliminar'],
            dangerMode: true
        }).then((confirm) => {
            if (confirm) {
                $.ajax({
                    url: '/system/php/routing/Index.php',
                    type: 'POST',
                    data: { data: JSON.stringify(data), deleteRole: true },
                    success: (response) => {
                        if (response.success) {
                            swal('Eliminado', response.message, 'success').then(() => {
                                window.location.href = 'roles';
                            });
                        } else {
                            swal('Error', response.message, 'error');
                        }
                    },
                    error: () => swal('Error', 'Ocurrió un error en el servidor', 'error')
                });
            }
        });
    },

    sendRequest: function (action, successMessage, redirectTo = null) {
        const data = this.getFormData();

        $.ajax({
            url: '/system/php/routing/Index.php',
            type: 'POST',
            data: { data: JSON.stringify(data), [action]: true },
            success: (response) => {
                if (response.success) {
                    swal('Éxito', successMessage, 'success').then(() => {
                        if (redirectTo) {
                            window.location.href = redirectTo;
                        } else {
                            window.location.reload();
                        }
                    });
                } else {
                    swal('Error', response.message, 'error');
                }
            },
            error: () => swal('Error', 'Ocurrió un error en el servidor', 'error')
        });
    }
};

// Initialize on document ready
$(document).ready(function () {
    roles.init();
});
