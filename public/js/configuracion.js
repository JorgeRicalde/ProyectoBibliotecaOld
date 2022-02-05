$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    method: "POST",
    type: "POST",
    dataType: "json",
    data: { _method: "GET" },
    statusCode: {
        401: function () {
            Swal.fire({
                title: "Error!",
                text: "Iniciar sesion primero",
                icon: "warning",
                confirmButtonText: "Cerrar",
            });
        },
        403: function () {
            Swal.fire({
                title: "Error!",
                text: "Esta acción no está autorizada",
                icon: "error",
                confirmButtonText: "Cerrar",
            });
        },
        404: function () {
            Swal.fire({
                title: "Error!",
                text: "Pagina no encontrada",
                icon: "error",
                confirmButtonText: "Cerrar",
            });
        },
        422: function ({ responseJSON }) {
            let errors = "";
            Object.entries(responseJSON.errors).forEach(function ([
                key,
                value,
            ]) {
                errors += `<p class='m-0'>${value}</p>`;
            });
            Swal.fire({
                title: "Los datos proporcionados no son válidos.",
                html: errors,
                icon: "error",
                confirmButtonText: "Cerrar",
            });
        },
        500: function () {
            Swal.fire({
                title: "Error!",
                text: "Error interno del servidor",
                icon: "error",
                confirmButtonText: "Cerrar",
            });
        },
    },
});

Pace.options.restartOnRequestAfter = true;
Pace.options.restartOnPushState = true;

const languageDataTables = {
    aria: {
        sortAscending: "Activar para ordenar la columna de manera ascendente",
        sortDescending: "Activar para ordenar la columna de manera descendente",
    },
    autoFill: {
        cancel: "Cancelar",
        fill: "Rellene todas las celdas con <i>%d</i>",
        fillHorizontal: "Rellenar celdas horizontalmente",
        fillVertical: "Rellenar celdas verticalmente",
    },
    buttons: {
        collection: "Colección",
        colvis: "Visibilidad",
        colvisRestore: "Restaurar visibilidad",
        copy: "Ejemplarr",
        copyKeys:
            "Presione ctrl o u2318 + C para ejemplarr los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
        copySuccess: {
            1: "Ejemplarda 1 fila al portapapeles",
            _: "Ejemplardas %d fila al portapapeles",
        },
        copyTitle: "Ejemplarr al portapapeles",
        csv: "CSV",
        excel: "Excel",
        pageLength: {
            "-1": "Mostrar todas las filas",
            _: "Mostrar %d filas",
        },
        pdf: "PDF",
        print: "Imprimir",
    },
    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
    infoFiltered: "(filtrado de un total de _MAX_ registros)",
    infoThousands: ",",
    lengthMenu: "Mostrar _MENU_ registros",
    loadingRecords: "<i class='fas fa-spinner fa-pulse'></i> Cargando...",
    paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
    },
    processing: "<i class='fas fa-spinner fa-pulse'></i> Procesando...",
    search: "Buscar:",
    searchBuilder: {
        add: "Añadir condición",
        button: {
            0: "Constructor de búsqueda",
            _: "Constructor de búsqueda (%d)",
        },
        clearAll: "Borrar todo",
        condition: "Condición",
        deleteTitle: "Eliminar regla de filtrado",
        leftTitle: "Criterios anulados",
        logicAnd: "Y",
        logicOr: "O",
        rightTitle: "Criterios de sangría",
        title: {
            0: "Constructor de búsqueda",
            _: "Constructor de búsqueda (%d)",
        },
        value: "Valor",
        conditions: {
            date: {
                after: "Después",
                before: "Antes",
                between: "Entre",
                empty: "Vacío",
                equals: "Igual a",
                not: "Diferente de",
                notBetween: "No entre",
                notEmpty: "No vacío",
            },
            number: {
                between: "Entre",
                empty: "Vacío",
                equals: "Igual a",
                gt: "Mayor a",
                gte: "Mayor o igual a",
                lt: "Menor que",
                lte: "Menor o igual a",
                not: "Diferente de",
                notBetween: "No entre",
                notEmpty: "No vacío",
            },
            string: {
                contains: "Contiene",
                empty: "Vacío",
                endsWith: "Termina con",
                equals: "Igual a",
                not: "Diferente de",
                startsWith: "Inicia con",
                notEmpty: "No vacío",
            },
            array: {
                equals: "Igual a",
                empty: "Vacío",
                contains: "Contiene",
                not: "Diferente",
                notEmpty: "No vacío",
                without: "Sin",
            },
        },
        data: "Datos",
    },
    searchPanes: {
        clearMessage: "Borrar todo",
        collapse: {
            0: "Paneles de búsqueda",
            _: "Paneles de búsqueda (%d)",
        },
        count: "{total}",
        emptyPanes: "Sin paneles de búsqueda",
        loadMessage: "Cargando paneles de búsqueda",
        title: "Filtros Activos - %d",
        countFiltered: "{shown} ({total})",
    },
    select: {
        cells: {
            1: "1 celda seleccionada",
            _: "$d celdas seleccionadas",
        },
        columns: {
            1: "1 columna seleccionada",
            _: "%d columnas seleccionadas",
        },
    },
    thousands: ",",
    datetime: {
        previous: "Anterior",
        hours: "Horas",
        minutes: "Minutos",
        seconds: "Segundos",
        unknown: "-",
        amPm: ["am", "pm"],
        next: "Siguiente",
        months: {
            0: "Enero",
            1: "Febrero",
            10: "Noviembre",
            11: "Diciembre",
            2: "Marzo",
            3: "Abril",
            4: "Mayo",
            5: "Junio",
            6: "Julio",
            7: "Agosto",
            8: "Septiembre",
            9: "Octubre",
        },
        weekdays: [
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
        ],
    },
    editor: {
        close: "Cerrar",
        create: {
            button: "Nuevo",
            title: "Crear Nuevo Registro",
            submit: "Crear",
        },
        edit: {
            button: "Editar",
            title: "Editar Registro",
            submit: "Actualizar",
        },
        remove: {
            button: "Eliminar",
            title: "Eliminar Registro",
            submit: "Eliminar",
            confirm: {
                _: "¿Está seguro que desea eliminar %d filas?",
                1: "¿Está seguro que desea eliminar 1 fila?",
            },
        },
        multi: {
            title: "Múltiples Valores",
            restore: "Deshacer Cambios",
            noMulti:
                "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
            info: "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga click o toque aquí, de lo contrario conservarán sus valores individuales.",
        },
        error: {
            system: 'Ha ocurrido un error en el sistema (<a target="\\" rel="\\ nofollow" href="\\"> Más información</a>).',
        },
    },
    decimal: ".",
    emptyTable: "No hay datos disponibles en la tabla",
    info: "Mostrando de _START_ al _END_ de  _TOTAL_ registros",
    zeroRecords: "No se encontraron coincidencias",
};

const dataTableCustomize = {
    watermark: {
        text: "Colegio Prisma",
        bold: true,
        color: "gray",
        opacity: 0.2,
    },
    tableHeader: {
        alignment: "center",
        fontSize: "10",
        bold: true,
        color: "#FFFFFF",
        fillColor: "#000000",
    },
    tableFooter: {
        alignment: "center",
        fontSize: "10",
        bold: true,
        color: "#FFFFFF",
        fillColor: "#000000",
    },
    title: {
        color: "#000000",
        fontSize: "25",
        bold: true,
        alignment: "center",
    },
    layout: {
        hLineWidth: function (i, node) {
            return 1;
        },
        vLineWidth: function (i, node) {
            return 1;
        },
        hLineColor: function (i, node) {
            return "#000000";
        },
        vLineColor: function (i, node) {
            return "#000000";
        },
    },
    footer: function (page, pages) {
        return {
            columns: [
                {
                    alignment: "left",
                    text: `Fecha de Creacion: ${new Date().toLocaleString()}`,
                },
                {
                    alignment: "right",
                    text: `pagina ${page.toString()} de ${pages.toString()}`,
                },
            ],
            margin: [40, 0, 40, 0],
        };
    },
    alignmentOdd: "center",
    alignmentEven: "center",
    fillColorOdd: "#C7C7C7",
    fillColorEven: "#E9E9E9",
};

$(".fecha-picker").datetimepicker({
    format: "YYYY-MM-DD",
    icons: {
        time: "fas fa-clock",
        date: "fas fa-calendar-alt",
        up: "fas fa-arrow-up",
        down: "fas fa-arrow-down",
        previous: "fas fa-chevron-left",
        next: "fas fa-chevron-right",
        today: "fas fa-calendar-check-o",
        clear: "fas fa-trash",
        close: "fas fa-times",
    },
    buttons: { showClose: true, showToday: true, showClear: true },
});

$(".anyo-picker").datetimepicker({
    format: "YYYY",
    icons: {
        time: "fas fa-clock",
        date: "fas fa-calendar-alt",
        up: "fas fa-arrow-up",
        down: "fas fa-arrow-down",
        previous: "fas fa-chevron-left",
        next: "fas fa-chevron-right",
        today: "fas fa-calendar-check-o",
        clear: "fas fa-trash",
        close: "fas fa-times",
    },
    buttons: { showClose: true, showToday: true },
});

const addTextDays = (dia) => `${dia} ${dia == 1 ? "dia" : "dias"}`;

const stringToArray = (texto) =>
    typeof texto === "string" ? texto.split(",") : null;

const formatDataOfDataTable = function (data) {
    return {
        columna: data["columns"][data["order"][0]["column"]]["data"],
        sentido: data["order"][0]["dir"],
        texto: data["search"]["value"],
        saltar: data["start"],
        tomar: data["length"],
        draw: data["draw"],
    };
};

const formatDataOfSelect2 = function (params) {
    let pagina = (params["page"] || 1) - 1;
    let tomar = 15;
    let saltar = pagina * tomar;
    return {
        pagina: pagina,
        tomar: tomar,
        saltar: saltar,
    };
};
const formatResultOfSelect2 = function (data, params) {
    params = formatDataOfSelect2(params);
    return {
        results: data,
        pagination: {
            more: Array.isArray(data) ? params["tomar"] === data.length : false,
        },
    };
};

const formatSancionCodigo = function (codigo) {
    let formato = "SN-000000000";
    return (
        formato.substring(0, formato.length - String(codigo).length) + codigo
    );
};

const formatPrestamoCodigo = function (codigo) {
    let formato = "PR-000000000";
    return (
        formato.substring(0, formato.length - String(codigo).length) + codigo
    );
};

$(document).on("click", ".btn-salir", function (e) {
    e.preventDefault();
    $("#logout-form").trigger("submit");
});

bsCustomFileInput.init();
