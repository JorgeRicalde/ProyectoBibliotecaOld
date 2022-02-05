const frmPrestamo = $(`form#frmPrestamo`);
const frmCampos = {
    id: $("#frm_id"),
    lector_id: $("#frm_lector_id"),
    lector: $("#frm_lector"),
    ejemplar_id: $("#frm_ejemplar_id"),
    libro: $("#frm_libro"),
    fecha_prestamo: $("#frm_fecha_prestamo"),
    fecha_devolucion: $("#frm_fecha_devolucion"),
    estado_fisico_del_ejemplar_id: $("#frm_estado_fisico_del_ejemplar_id"),
    estado_del_prestamo_id: $("#frm_estado_del_prestamo_id"),
    dias_de_prestamo: $("#frm_dias_de_prestamo"),
};

const modalDetalles = $(`#modalDetallesPrestamo`);
const frmDetallesPrestamo = $(`form#frmDetallesPrestamo`);
const frmDetallesCampos = {
    lector: $("#modal_lector"),
    libro: $("#modal_libro"),
    estado_fisico_del_ejemplar: $("#modal_estado_fisico_del_ejemplar"),
    estado_del_prestamo: $("#modal_estado_del_prestamo"),
    dias_de_prestamo_text: $("#modal_dias_de_prestamo_text"),
    fecha_prestamo: $("#modal_fecha_prestamo"),
    fecha_devolucion: $("#modal_fecha_devolucion"),
};

const frmRegistrarSancion = $(`form#frmRegistrarSancion`);
const frmRegistrarSancionCampos = {
    id: $("#modal_id"),
    fecha_inicio: $("#modal_fecha_inicio"),
    fecha_fin: $("#modal_fecha_fin"),
    estado_de_la_sancion_id: $("#modal_estado_de_la_sancion_id"),
    tipo_de_sancion_id: $("#modal_tipo_de_sancion_id"),
    prestamo: $("#modal_prestamo"),
    lector_id: $("#modal_lector_id"),
    lector: $("#modal_lector_nombre"),
};

const txtTitulo = $(`#frmTitulo`);
const contenedorRegistrar = $(`#opcionesRegistrarPrestamo`);
const contenedorEditar = $(`#opcionesEditarPrestamo`);

const modalRegistrarSancion = $(`#modalRegistrarSancion`).on(
    "hidden.bs.modal",
    function () {
        frmRegistrarSancion.get(0).reset();
        frmRegistrarSancionCampos["id"].val(null);
        frmRegistrarSancionCampos["fecha_fin"].val(null);
        frmRegistrarSancionCampos["fecha_inicio"].val(null);
        frmRegistrarSancionCampos["lector"].val(null);
        frmRegistrarSancionCampos["lector_id"].val(null);
        frmRegistrarSancionCampos["prestamo"].val(null);
        frmRegistrarSancionCampos["tipo_de_sancion_id"]
            .val(null)
            .trigger("change");
        frmRegistrarSancionCampos["estado_de_la_sancion_id"]
            .val(null)
            .trigger("change");
    }
);

const modalBuscarLector = $(`#modalBuscarLector`).on(
    "show.bs.modal",
    function () {
        tblLectores.draw();
    }
);
const modalBuscarReserva = $(`#modalBuscarReserva`).on(
    "show.bs.modal",
    function () {
        tblReservas.draw();
    }
);

const modalBuscarEjemplar = $(`#modalBuscarEjemplar`).on(
    "hidden.bs.modal",
    function () {
        slcLibro.val(null).trigger("change");
        if (tblEjemplares.ajax.url(url.limpiar).data().count() > 0) {
            tblEjemplares.draw();
        }
    }
);

const tblPrestamos = $(`#tblPrestamos`)
    .DataTable({
        responsive: true,
        language: languageDataTables,
        dom: '<"row" <"col-sm-6" B> <"col-sm-6" f> > <"row" <"col-12" tr> > <"row" <"col-sm-5" i> <"col-sm-7" p> >',
        buttons: {
            dom: {
                button: { className: "btn" },
            },
            buttons: [
                {
                    extend: "pageLength",
                    className: "btn-default",
                },
                {
                    text: '<i class="fas fa-sync-alt"></i>',
                    className: "btn-default",
                    action: function () {
                        tblPrestamos.draw();
                    },
                },
            ],
        },
        processing: true,
        serverSide: true,
        deferLoading: 0,
        searchDelay: 1000,
        ajax: {
            url: url.datatable,
            type: "POST",
            data: formatDataOfDataTable,
        },
        order: [[4, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><a href="#frmTitulo" class="btn btn-xs btn-default text-success mx-1 shadow btn-editar-prestamo" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a><button class="btn btn-xs btn-default text-info mx-1 shadow btn-ver-detalles-prestamo" title="Detalles"><i class="fa fa-lg fa-fw fa-eye"></i></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "lector" },
            { data: "libro" },
            { data: "estado_del_prestamo" },
            { data: "fecha_prestamo" },
            { data: "fecha_devolucion", defaultContent: "No Devuelto" },
        ],
    })
    .on("draw.dt", function () {
        tblPrestamos.columns.adjust();
    });

const tblEjemplares = $(`#tblEjemplares`)
    .DataTable({
        responsive: true,
        language: languageDataTables,
        dom: '<"row" <"col-sm-6" B> <"col-sm-6" f> > <"row" <"col-12" tr> > <"row" <"col-sm-5" i> <"col-sm-7" p> >',
        buttons: {
            dom: {
                button: { className: "btn" },
            },
            buttons: [
                {
                    extend: "pageLength",
                    className: "btn-default",
                },
            ],
        },
        processing: true,
        serverSide: true,
        deferLoading: 0,
        searchDelay: 1000,
        ajax: {
            url: url.ejemplares.replace("#", 0),
            type: "POST",
            data: formatDataOfDataTable,
        },
        order: [[1, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><button class="btn btn-xs btn-default text-success mx-1 shadow btn-seleccionar-ejemplar" title="Seleccionar Ejemplar"><i class="fa fa-lg fa-check-circle"></i></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "libro" },
            { data: "estado_fisico_del_ejemplar" },
        ],
    })
    .on("draw.dt", function () {
        tblEjemplares.columns.adjust();
    });

const tblLectores = $(`#tblLectores`)
    .DataTable({
        responsive: true,
        language: languageDataTables,
        dom: '<"row" <"col-sm-6" B> <"col-sm-6" f> > <"row" <"col-12" tr> > <"row" <"col-sm-5" i> <"col-sm-7" p> >',
        buttons: {
            dom: {
                button: { className: "btn" },
            },
            buttons: [
                {
                    extend: "pageLength",
                    className: "btn-default",
                },
            ],
        },
        processing: true,
        serverSide: true,
        deferLoading: 0,
        searchDelay: 1000,
        ajax: {
            url: url.usuarios,
            type: "POST",
            data: formatDataOfDataTable,
        },
        order: [[1, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><button class="btn btn-xs btn-default text-success mx-1 shadow btn-seleccionar-lector" title="Seleccionar Lector"><i class="fa fa-lg fa-check-circle"></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "name" },
            { data: "last_name" },
            { data: "rol" },
        ],
    })
    .on("draw.dt", function () {
        tblLectores.columns.adjust();
    });

const tblReservas = $(`#tblReservas`)
    .DataTable({
        responsive: true,
        language: languageDataTables,
        dom: '<"row" <"col-sm-6" B> <"col-sm-6" f> > <"row" <"col-12" tr> > <"row" <"col-sm-5" i> <"col-sm-7" p> >',
        buttons: {
            dom: {
                button: { className: "btn" },
            },
            buttons: [
                {
                    extend: "pageLength",
                    className: "btn-default",
                },
            ],
        },
        processing: true,
        serverSide: true,
        deferLoading: 0,
        searchDelay: 1000,
        ajax: {
            url: url.reservaciones,
            type: "POST",
            data: formatDataOfDataTable,
        },
        order: [[4, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><button class="btn btn-xs btn-default text-success mx-1 shadow btn-seleccionar-reserva" title="Seleccionar Lector"><i class="fa fa-lg fa-check-circle"></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "libro" },
            { data: "lector" },
            { data: "dias_de_prestamo", render: addTextDays },
            { data: "fecha_de_reservacion" },
        ],
    })
    .on("draw.dt", function () {
        tblReservas.columns.adjust();
    });

frmCampos["fecha_prestamo"].val(moment().format("DD/MM/YYYY"));

const slcLibro = $("#slcLibro")
    .select2({
        theme: "bootstrap4",
        placeholder: "Seleccione un Libro",
        ajax: {
            delay: 1000,
            type: "POST",
            data: formatDataOfSelect2,
            processResults: formatResultOfSelect2,
            url: function (params) {
                return url.libros.replace("#", params.term || "");
            },
        },
    })
    .on("select2:select", function ({ params }) {
        let data = params.data;
        if (Boolean(data)) {
            tblEjemplares.ajax
                .url(url.ejemplares.replace("#", data["id"]))
                .draw();
        } else {
            Swal.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Seleccione un Libro",
            });
        }
    });

frmCampos["dias_de_prestamo"]
    .bootstrapSlider({
        id: "frm_dias_de_prestamo-slider",
        value: 1,
        min: 1,
        max: 14,
        formatter: addTextDays,
    })
    .on("change", function () {
        let dias = parseInt(this.value) || 0;
        if (dias >= 0 && dias <= 14) {
            frmCampos["fecha_devolucion"].val(
                moment(frmCampos["fecha_prestamo"].val(), "DD/MM/YYYY")
                    .add(dias, "days")
                    .format("DD/MM/YYYY")
            );
        }
    });

const btnLimpiarForm = $("#btnLimpiarForm").on("click", function () {
    frmCampos["id"].val(null);
    frmCampos["lector_id"].val(null);
    frmCampos["lector"].val(null);
    frmCampos["ejemplar_id"].val(null);
    frmCampos["libro"].val(null);
    frmCampos["fecha_prestamo"].val(moment().format("DD/MM/YYYY"));
    frmCampos["fecha_devolucion"].val(null);
    frmCampos["estado_fisico_del_ejemplar_id"].val(null).trigger("change");
    frmCampos["estado_del_prestamo_id"].val(null).trigger("change");
    frmCampos["dias_de_prestamo"].bootstrapSlider("setValue", 1).change();
});

$(document)
    .on("click", ".btn-editar-prestamo", function () {
        let dataRow = tblPrestamos.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            contenedorRegistrar.addClass("d-none");
            contenedorEditar.removeClass("d-none");
            txtTitulo.text("Editar Prestamo");
            frmCampos["id"].val(dataRow["id"]);
            frmCampos["lector_id"].val(dataRow["lector_id"]);
            frmCampos["lector"].val(dataRow["lector"]);
            frmCampos["ejemplar_id"].val(dataRow["ejemplar_id"]);
            frmCampos["libro"].val(dataRow["libro"]);
            frmCampos["fecha_prestamo"].val(
                moment(dataRow["fecha_prestamo"]).format("DD/MM/YYYY")
            );
            frmCampos["estado_fisico_del_ejemplar_id"]
                .val(stringToArray(dataRow["estado_fisico_del_ejemplar_id"]))
                .trigger("change");
            frmCampos["estado_del_prestamo_id"]
                .val(dataRow["estado_del_prestamo_id"])
                .trigger("change");
            frmCampos["dias_de_prestamo"]
                .bootstrapSlider("setValue", dataRow["dias_de_prestamo"])
                .change();
        }
    })
    .on("click", ".btn-ver-detalles-prestamo", function () {
        frmDetallesPrestamo.get(0).reset();
        let dataRow = tblPrestamos.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmDetallesCampos["lector"].val(dataRow["lector"]);
            frmDetallesCampos["libro"].val(dataRow["libro"]);
            frmDetallesCampos["estado_fisico_del_ejemplar"].val(
                dataRow["estado_fisico_del_ejemplar"]
            );
            frmDetallesCampos["estado_del_prestamo"].val(
                dataRow["estado_del_prestamo"]
            );
            frmDetallesCampos["dias_de_prestamo_text"].val(
                addTextDays(dataRow["dias_de_prestamo"])
            );
            frmDetallesCampos["fecha_prestamo"].val(dataRow["fecha_prestamo"]);
            frmDetallesCampos["fecha_devolucion"].val(
                dataRow["fecha_devolucion"] || "No Devuelto"
            );
            modalDetalles.modal(`show`);
        }
    })
    .on("click", ".btn-seleccionar-ejemplar", function () {
        let dataRow = tblEjemplares.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmCampos["ejemplar_id"].val(dataRow["id"]);
            frmCampos["libro"].val(dataRow["libro"]);
            frmCampos["estado_fisico_del_ejemplar_id"]
                .val(stringToArray(dataRow["estado_fisico_del_ejemplar_id"]))
                .trigger("change");
            modalBuscarEjemplar.modal("hide");
        }
    })
    .on("click", ".btn-seleccionar-reserva", function () {
        let dataRow = tblReservas.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmCampos["ejemplar_id"].val(dataRow["ejemplar_id"]);
            frmCampos["libro"].val(dataRow["libro"]);
            frmCampos["lector_id"].val(dataRow["lector_id"]);
            frmCampos["lector"].val(dataRow["lector"]);
            frmCampos["estado_fisico_del_ejemplar_id"]
                .val(stringToArray(dataRow["estado_fisico_del_ejemplar_id"]))
                .trigger("change");
            frmCampos["dias_de_prestamo"]
                .bootstrapSlider("setValue", dataRow["dias_de_prestamo"])
                .change();
            modalBuscarReserva.modal("hide");
        }
    })
    .on("click", ".btn-seleccionar-lector", function () {
        let dataRow = tblLectores.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmCampos["lector_id"].val(dataRow["id"]);
            frmCampos["lector"].val(
                `${dataRow["name"]} ${dataRow["last_name"]}`
            );
            modalBuscarLector.modal("hide");
        }
    })
    .on("click", "#btnCancelarEdicion", function () {
        contenedorEditar.addClass("d-none");
        contenedorRegistrar.removeClass("d-none");
        txtTitulo.text("Registrar un Nuevo Prestamo");
        btnLimpiarForm.trigger("click");
    })
    .on("click", "#btnRegistrarPrestamo", function () {
        let formData = new FormData(frmPrestamo.get(0));
        formData.append("_method", "POST");
        $.ajax({
            url: url.registrar,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function ({ mensaje }) {
                Swal.fire({
                    icon: "success",
                    title: "Hecho",
                    text: mensaje,
                });
                tblPrestamos.draw();
            },
        });
    })
    .on("click", "#btnEditarPrestamo", function () {
        let formData = new FormData(frmPrestamo.get(0));
        formData.append("_method", "PUT");
        $.ajax({
            url: url.actualizar.replace("#", formData.get("id")),
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function ({ mensaje }) {
                Swal.fire({
                    icon: "success",
                    title: "Hecho",
                    text: mensaje,
                });
                tblPrestamos.draw();
            },
        });
    })
    .on("click", "#btnRegistrarSancion", function () {
        let formData = new FormData(frmRegistrarSancion.get(0));
        formData.append("_method", "POST");
        $.ajax({
            url: url.sancion,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function ({ mensaje }) {
                Swal.fire({
                    icon: "success",
                    title: "Hecho",
                    text: mensaje,
                });
                tblPrestamos.draw();
            },
        });
    })
    .on("click", "#btnIncrementar", function () {
        frmCampos["dias_de_prestamo"]
            .bootstrapSlider(
                "setValue",
                frmCampos["dias_de_prestamo"].bootstrapSlider("getValue") + 1
            )
            .change();
    })
    .on("click", "#btnDisminuir", function () {
        frmCampos["dias_de_prestamo"]
            .bootstrapSlider(
                "setValue",
                frmCampos["dias_de_prestamo"].bootstrapSlider("getValue") - 1
            )
            .change();
    })
    .on("click", "#btnModalSancion", function () {
        frmRegistrarSancionCampos["id"].val(frmCampos["id"].val());
        frmRegistrarSancionCampos["prestamo"].val(
            `${frmCampos["libro"].val()} | ${frmCampos["fecha_prestamo"].val()}`
        );
        frmRegistrarSancionCampos["lector_id"].val(
            frmCampos["lector_id"].val()
        );
        frmRegistrarSancionCampos["lector"].val(frmCampos["lector"].val());
        modalRegistrarSancion.modal("show");
    })
    .on("click", "#btnBuscarLector", function () {
        modalBuscarLector.modal("show");
    })
    .on("click", "#btnBuscarLibro", function () {
        modalBuscarEjemplar.modal("show");
    })
    .on("click", "#btnBuscarReserva", function () {
        modalBuscarReserva.modal("show");
    });

$.ajax({
    url: url.select2,
    data: {
        campos: [
            "estados_fisicos_de_los_ejemplares",
            "estados_de_los_prestamos",
            "estados_de_las_sanciones",
            "tipos_de_sanciones",
        ],
    },
    success: function (data) {
        tblPrestamos.draw();
        frmCampos["estado_fisico_del_ejemplar_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado Fisico de la Ejemplar",
                data: data["estados_fisicos_de_los_ejemplares"],
            })
            .val(null)
            .trigger("change");
        frmCampos["estado_del_prestamo_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado del Prestamo",
                data: data["estados_de_los_prestamos"],
            })
            .val(null)
            .trigger("change");
        frmRegistrarSancionCampos["estado_de_la_sancion_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado del Sancion",
                data: data["estados_de_las_sanciones"],
            })
            .val(null)
            .trigger("change");
        frmRegistrarSancionCampos["tipo_de_sancion_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Tipo de Sancion",
                data: data["tipos_de_sanciones"],
            })
            .val(null)
            .trigger("change");
    },
});

btnLimpiarForm.trigger("click");
