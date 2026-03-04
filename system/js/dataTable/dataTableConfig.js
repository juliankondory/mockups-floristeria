/**
 * DataTable Configuration - PRETECOR
 * Configuración estándar para todos los DataTables del sistema
 */

const datatables = {
    data: {
        dataTable: null,

        // Rutas donde se inicializa DataTable
        pathRender: [
            'roles',
            'modules',
            'views',
            'users',
            'administrators',
            'referencias',
            'ordenes',
            'supply-types',
            'supplies',
            'suppliers',
            'clients'
        ],

        // ============================================================
        // COLUMNAS POR MÓDULO
        // ============================================================

        columnsRole: [
            { data: 'id_rol', title: 'ID', width: '50px', className: 'text-center' },
            { data: 'nombre', title: 'Nombre', width: '150px' },
            { data: 'descripcion', title: 'Descripción' },
            { data: 'tipo_legacy', title: 'Tipo Legacy', width: '100px', className: 'text-center' },
            {
                data: 'activo',
                title: 'Estado',
                width: '100px',
                className: 'text-center',
                render: function (data, type, row) {
                    if (data == 1) {
                        return '<span class="badge bg-success">Activo</span>';
                    } else {
                        return '<span class="badge bg-secondary">Inactivo</span>';
                    }
                }
            },
            {
                data: 'btnEdit',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsModule: [
            { data: 'id_modulo', title: 'ID', width: '50px', className: 'text-center' },
            {
                data: 'icono',
                title: 'Icono',
                width: '60px',
                className: 'text-center',
                orderable: false,
                render: function (data, type, row) {
                    return `<i class="${data}" style="font-size: 24px; color: ${row.color || '#000'};"></i>`;
                }
            },
            { data: 'titulo', title: 'Título', width: '150px' },
            { data: 'nombre', title: 'Nombre', width: '120px' },
            {
                data: 'tipo',
                title: 'Tipo',
                width: '100px',
                className: 'text-center',
                render: function (data, type, row) {
                    if (data === 'modulo_padre') {
                        return '<span class="badge bg-primary">Padre</span>';
                    } else {
                        return '<span class="badge bg-info">Hijo</span>';
                    }
                }
            },
            { data: 'ruta', title: 'Ruta', width: '120px' },
            { data: 'orden', title: 'Orden', width: '70px', className: 'text-center' },
            {
                data: 'mostrar_en_dashboard',
                title: 'Dashboard',
                width: '100px',
                className: 'text-center',
                render: function (data, type, row) {
                    return data == 1 ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle-fill text-secondary"></i>';
                }
            },
            {
                data: 'activo',
                title: 'Estado',
                width: '100px',
                className: 'text-center',
                render: function (data, type, row) {
                    return data == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                }
            },
            {
                data: 'btnEdit',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsView: [
            { data: 'id_vista', title: 'ID', width: '50px', className: 'text-center' },
            { data: 'titulo_modulo', title: 'Módulo', width: '150px' },
            { data: 'nombre', title: 'Nombre', width: '180px' },
            { data: 'ruta', title: 'Ruta', width: '180px' },
            {
                data: 'orden',
                title: 'Orden',
                width: '70px',
                className: 'text-center'
            },
            {
                data: 'activo',
                title: 'Estado',
                width: '90px',
                className: 'text-center',
                render: function (data, type, row) {
                    return data == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                }
            },
            {
                data: 'btnEdit',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsUser: [
            { data: 'id_usuario', title: 'ID', width: '50px', className: 'text-center' },
            { data: 'nombre', title: 'Nombre', width: '200px' },
            { data: 'correo', title: 'Correo', width: '200px' },
            { data: 'telefono', title: 'Teléfono', width: '120px' },
            { data: 'cedula', title: 'Cédula', width: '120px' },
            { data: 'rol_nombre', title: 'Rol', width: '120px' },
            {
                data: 'estado',
                title: 'Estado',
                width: '100px',
                className: 'text-center',
                render: function (data, type, row) {
                    return data == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                }
            },
            {
                data: 'btnEdit',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsAdministrator: [
            { data: 'id_administrador', title: 'ID', width: '50px', className: 'text-center' },
            { data: 'nombre', title: 'Nombre', width: '200px' },
            { data: 'correo', title: 'Correo', width: '200px' },
            { data: 'telefono', title: 'Teléfono', width: '120px' },
            { data: 'cedula', title: 'Cédula', width: '120px' },
            {
                data: 'estado',
                title: 'Estado',
                width: '100px',
                className: 'text-center',
                render: function (data, type, row) {
                    return data == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                }
            },
            {
                data: 'btnEdit',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsReferencia: [
            { data: 'id_referencia', title: 'ID', width: '50px', className: 'text-center' },
            { data: 'nombre', title: 'Referencia', width: '100px', className: 'text-center' },
            { data: 'longitud_total', title: 'Longitud', width: '80px', className: 'text-center' },
            { data: 'norma', title: 'Norma', width: '100px' },
            { data: 'numero_secciones', title: 'Secc.', width: '60px', className: 'text-center' },
            { data: 'peso_total', title: 'Peso Total', width: '100px', className: 'text-end' },
            { data: 'diametro_cima', title: 'Ø Cima', width: '80px', className: 'text-end' },
            { data: 'diametro_base', title: 'Ø Base', width: '80px', className: 'text-end' },
            {
                data: 'tipo_produccion',
                title: 'Tipo Prod.',
                width: '100px',
                render: function (data, type, row) {
                    let badge = 'bg-secondary';
                    if (data === 'Balance') badge = 'bg-primary';
                    else if (data === 'Esthetic') badge = 'bg-success';
                    else if (data === 'Smart') badge = 'bg-info';
                    return `<span class="badge ${badge}">${data}</span>`;
                }
            },
            {
                data: 'activo',
                title: 'Estado',
                width: '80px',
                className: 'text-center',
                render: function (data, type, row) {
                    return data == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-secondary">Inactivo</span>';
                }
            },
            {
                data: 'btnEdit',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsWorkOrder: [
            { data: 'id_orden', title: 'ID', width: '50px', className: 'text-center' },
            { data: 'numero_orden', title: 'Nº Orden', width: '120px', className: 'text-center fw-bold' },
            { data: 'nombre_cliente', title: 'Cliente', width: '200px' },
            { data: 'fecha_creacion', title: 'F. Creación', width: '100px', className: 'text-center' },
            { data: 'fecha_entrega', title: 'F. Entrega', width: '100px', className: 'text-center' },
            { data: 'estado', title: 'Estado', width: '100px', className: 'text-center' },
            { data: 'tipo_produccion', title: 'Tipo Prod.', width: '100px', className: 'text-center' },
            { data: 'total_lineas', title: 'Líneas', width: '70px', className: 'text-center' },
            { data: 'total_postes', title: 'Postes', width: '70px', className: 'text-center' },
            {
                data: 'actions',
                title: 'Ver',
                width: '70px',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ],

        columnsSupplyType: [
            { data: 'id_tipo_insumo', title: 'ID', width: '20px', className: 'text-center align-middle' },
            { data: 'nombre', title: 'Nombre', className: 'align-middle' },
            { data: 'descripcion', title: 'Descripción', className: 'align-middle' },
            {
                data: 'btnEdit',
                title: '',
                className: 'text-center align-middle',
                width: '70px',
                orderable: false,
                searchable: false
            }
        ],

        columnsSupply: [
            { data: 'id_insumo', title: 'ID', width: '20px', className: 'text-center align-middle' },
            { data: 'nombre', title: 'Nombre', className: 'align-middle' },
            { data: 'nombre_tipo_insumo', title: 'Tipo Insumo', width: '150px', className: 'align-middle' },
            { data: 'nombre_proveedor', title: 'Proveedor', width: '180px', className: 'align-middle' },
            { data: 'descripcion', title: 'Descripción', className: 'align-middle' },
            {
                data: 'btnEdit',
                title: '',
                className: 'text-center align-middle',
                width: '70px',
                orderable: false,
                searchable: false
            }
        ],

        columnsSupplier: [
            { data: 'id_proveedor', title: 'ID', width: '20px', className: 'text-center align-middle' },
            { data: 'nombre', title: 'Nombre', width: '200px', className: 'align-middle' },
            { data: 'telefono', title: 'Teléfono', width: '100px', className: 'align-middle' },
            { data: 'correo', title: 'Correo', width: '150px', className: 'align-middle' },
            {
                data: 'btnEdit',
                title: '',
                className: 'text-center align-middle',
                width: '70px',
                orderable: false,
                searchable: false
            }
        ],

        columnsClient: [
            { data: 'id_cliente', title: 'ID', width: '20px', className: 'text-center align-middle' },
            { data: 'nombre', title: 'Nombre', width: '200px', className: 'align-middle' },
            { data: 'documento', title: 'Documento', width: '120px', className: 'align-middle' },
            { data: 'telefono', title: 'Teléfono', width: '100px', className: 'align-middle' },
            { data: 'correo', title: 'Correo', width: '150px', className: 'align-middle' },
            { data: 'ciudad', title: 'Ciudad', width: '100px', className: 'align-middle' },
            {
                data: 'btnEdit',
                title: '',
                className: 'text-center align-middle',
                width: '70px',
                orderable: false,
                searchable: false
            }
        ],

        // ============================================================
        // CONFIGURACIÓN ESTÁNDAR DATATABLE
        // ============================================================

        configDataTable: {
            processing: true,
            serverSide: true,
            searchDelay: 800,
            scrollX: "100%",
            autoWidth: false,
            responsive: false,
            search: {
                smart: true,
                return: true
            },
            language: {
                url: '/system/js/dataTable/Spanish.json'
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50], [10, 25, 50]],
            order: [[0, 'desc']]
        }
    },

    // ============================================================
    // MÉTODOS DE INICIALIZACIÓN
    // ============================================================

    init: function (currentPath) {
        this.destroy();

        switch (currentPath) {
            case 'roles':
                this.initDataTableRole();
                break;
            case 'modules':
                this.initDataTableModule();
                break;
            case 'views':
                this.initDataTableView();
                break;
            case 'users':
                this.initDataTableUser();
                break;
            case 'administrators':
                this.initDataTableAdministrator();
                break;
            case 'referencias':
                this.initDataTableReferencia();
                break;
            case 'ordenes':
                this.initDataTableWorkOrder();
                break;
            case 'supply-types':
                this.initDataTableSupplyType();
                break;
            case 'supplies':
                this.initDataTableSupply();
                break;
            case 'suppliers':
                this.initDataTableSupplier();
                break;
            case 'clients':
                this.initDataTableClient();
                break;
            default:
                break;
        }

        if (this.data.dataTable) {
            this.data.dataTable.on('draw', function () {
                // console.log('DataTable has been redrawn');
            });
        }
    },

    getCurrentPath: function () {
        const path = window.location.pathname;
        const segments = path.split('/');

        for (let i = segments.length - 1; i >= 0; i--) {
            if (this.data.pathRender.includes(segments[i])) {
                return segments[i];
            }
        }

        return '';
    },

    // ============================================================
    // INICIALIZACIÓN POR MÓDULO
    // ============================================================

    initDataTableRole: function () {
        this.data.dataTable = $('#dataTableRole').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getRoles: true }
            },
            columns: this.data.columnsRole
        });
    },

    initDataTableModule: function () {
        this.data.dataTable = $('#dataTableModule').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getModules: true }
            },
            columns: this.data.columnsModule,
            order: [[5, 'asc']] // Ordenar por columna 'orden'
        });
    },

    initDataTableView: function () {
        this.data.dataTable = $('#dataTableView').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getViews: true }
            },
            columns: this.data.columnsView
        });
    },

    initDataTableUser: function () {
        this.data.dataTable = $('#dataTableUser').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getUsers: true }
            },
            columns: this.data.columnsUser
        });
    },

    initDataTableAdministrator: function () {
        this.data.dataTable = $('#dataTableAdministrator').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getAdministrators: true }
            },
            columns: this.data.columnsAdministrator
        });
    },

    initDataTableReferencia: function () {
        this.data.dataTable = $('#dataTableReferencia').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getReferences: true }
            },
            columns: this.data.columnsReferencia
        });
    },

    initDataTableWorkOrder: function () {
        this.data.dataTable = $('#dataTableWorkOrder').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getWorkOrders: true }
            },
            columns: this.data.columnsWorkOrder
        });
    },

    initDataTableSupplyType: function () {
        this.data.dataTable = $('#dataTableSupplyTypes').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getTipoInsumos: true }
            },
            columns: this.data.columnsSupplyType
        });
    },

    initDataTableSupply: function () {
        this.data.dataTable = $('#dataTableSupplies').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getInsumos: true }
            },
            columns: this.data.columnsSupply
        });
    },

    initDataTableSupplier: function () {
        this.data.dataTable = $('#dataTableSuppliers').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getProveedores: true }
            },
            columns: this.data.columnsSupplier
        });
    },

    initDataTableClient: function () {
        this.data.dataTable = $('#dataTableClients').DataTable({
            ...this.data.configDataTable,
            ajax: {
                url: '/system/php/routing/Index.php',
                type: 'POST',
                data: { getClientes: true }
            },
            columns: this.data.columnsClient
        });
    },

    // ============================================================
    // MÉTODOS AUXILIARES
    // ============================================================

    destroy: function () {
        if (this.data.dataTable) {
            this.data.dataTable.destroy();
            this.data.dataTable = null;
        }
    },

    reload: function () {
        if (this.data.dataTable) {
            this.data.dataTable.ajax.reload(null, false);
        }
    },

    getInstance: function () {
        return this.data.dataTable;
    }
};

// ============================================================
// INICIALIZACIÓN AUTOMÁTICA
// ============================================================

$(function () {
    const currentPath = datatables.getCurrentPath();
    if (currentPath) {
        datatables.init(currentPath);
    }
    window.datatables = datatables;
});
