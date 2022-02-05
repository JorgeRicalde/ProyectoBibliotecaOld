const frmSancion = $(`form#frmSancion`);
const frmCampos = {
    id: $("#frm_id"),
    prestamo: $("#frm_prestamo"),
    estado_de_la_sancion_id: $("#frm_estado_de_la_sancion_id"),
    fecha_inicio: $("#frm_fecha_inicio"),
    fecha_fin: $("#frm_fecha_fin"),
    tipo_de_sancion_id: $("#frm_tipo_de_sancion_id"),
    lector_id: $("#frm_lector_id"),
    lector: $("#frm_lector"),
};

const modalDetalles = $(`#modalDetallesSancion`);
const frmDetallesSancion = $(`form#frmDetallesSancion`);
const frmDetallesCampos = {
    prestamo: $("#modal_prestamo"),
    estado_de_la_sancion: $("#modal_estado_de_la_sancion"),
    fecha_inicio: $("#modal_fecha_inicio"),
    fecha_fin: $("#modal_fecha_fin"),
    tipo_de_sancion: $("#modal_tipo_de_sancion"),
    lector: $("#modal_lector"),
};

const txtTitulo = $(`#frmTitulo`);
const contenedorRegistrar = $(`#opcionesRegistrarSancion`);
const contenedorEditar = $(`#opcionesEditarSancion`);

const modalBuscarPrestamo = $(`#modalBuscarPrestamo`).on(
    "shown.bs.modal",
    function () {
        tblPrestamos.draw();
    }
);
const modalBuscarLector = $(`#modalBuscarLector`).on(
    "shown.bs.modal",
    function () {
        tblLectores.draw();
    }
);

const tblSanciones = $(`#tblSanciones`)
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
                        tblSanciones.draw();
                    },
                },
            ],
        },
        processing: true,
        serverSide: true,
        searchDelay: 1000,
        ajax: {
            url: url.datatable,
            type: "POST",
            data: formatDataOfDataTable,
        },
        order: [[5, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><a href="#frmTitulo" class="btn btn-xs btn-default text-success mx-1 shadow btn-editar-sancion" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a><button class="btn btn-xs btn-default text-info mx-1 shadow btn-ver-detalles-sancion" title="Detalles"><i class="fa fa-lg fa-fw fa-eye"></i></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "lector" },
            { data: "libro" },
            { data: "estado_de_la_sancion" },
            { data: "tipo_de_sancion" },
            { data: "fecha_inicio" },
            { data: "fecha_fin" },
        ],
    })
    .on("draw.dt", function () {
        tblSanciones.columns.adjust();
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
            ],
        },
        processing: true,
        serverSide: true,
        deferLoading: 0,
        searchDelay: 1000,
        ajax: {
            url: url.prestamos,
            type: "POST",
            data: formatDataOfDataTable,
        },
        order: [[1, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><button class="btn btn-xs btn-default text-success mx-1 shadow btn-seleccionar-prestamo" title="Seleccionar Lector"><i class="fa fa-lg fa-check-circle"></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "fecha_prestamo" },
            { data: "libro" },
            { data: "lector" },
        ],
    })
    .on("draw.dt", function () {
        tblPrestamos.columns.adjust();
    });

const btnLimpiarForm = $("#btnLimpiarForm").on("click", function () {
    frmCampos["id"].val(null);
    frmCampos["prestamo"].val(null);
    frmCampos["estado_de_la_sancion_id"].val(null).trigger("change");
    frmCampos["fecha_inicio"].val(null);
    frmCampos["fecha_fin"].val(null);
    frmCampos["tipo_de_sancion_id"].val(null).trigger("change");
    frmCampos["lector_id"].val(null);
    frmCampos["lector"].val(null);
});

const btnBuscarPrestamo = $("#btnBuscarPrestamo").on("click", function () {
    modalBuscarPrestamo.modal("show");
});

$(document)
    .on("click", ".btn-editar-sancion", function () {
        let dataRow = tblSanciones.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            contenedorRegistrar.addClass("d-none");
            contenedorEditar.removeClass("d-none");
            txtTitulo.text("Editar Sancion");
            frmCampos["id"].val(dataRow["id"]);
            frmCampos["prestamo"].val(
                `${dataRow["libro"]} | ${dataRow["fecha_prestamo"]}`
            );
            frmCampos["estado_de_la_sancion_id"]
                .val(dataRow["estado_de_la_sancion_id"])
                .trigger("change");
            frmCampos["fecha_inicio"].val(dataRow["fecha_inicio"]);
            frmCampos["fecha_fin"].val(dataRow["fecha_fin"]);
            frmCampos["tipo_de_sancion_id"]
                .val(dataRow["tipo_de_sancion_id"])
                .trigger("change");
            frmCampos["lector_id"].val(dataRow["lector_id"]);
            frmCampos["lector"].val(dataRow["lector"]);
            btnBuscarPrestamo.attr("disabled", true);
        }
    })
    .on("click", ".btn-ver-detalles-sancion", function () {
        frmDetallesSancion.get(0).reset();
        let dataRow = tblSanciones.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmDetallesCampos["prestamo"].val(
                `${dataRow["libro"]} | ${dataRow["fecha_prestamo"]}`
            );
            frmDetallesCampos["estado_de_la_sancion"].val(
                dataRow["estado_de_la_sancion"]
            );
            frmDetallesCampos["fecha_inicio"].val(dataRow["fecha_inicio"]);
            frmDetallesCampos["fecha_fin"].val(dataRow["fecha_fin"]);
            frmDetallesCampos["tipo_de_sancion"].val(
                dataRow["tipo_de_sancion"]
            );
            frmDetallesCampos["lector"].val(dataRow["lector"]);
            modalDetalles.modal(`show`);
        }
    })
    .on("click", ".btn-seleccionar-prestamo", function () {
        let dataRow = tblPrestamos.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmCampos["id"].val(dataRow["id"]);
            frmCampos["prestamo"].val(
                `${dataRow["libro"]} | ${dataRow["fecha_prestamo"]}`
            );
            frmCampos["lector_id"].val(dataRow["lector_id"]);
            frmCampos["lector"].val(dataRow["lector"]);
            modalBuscarPrestamo.modal("hide");
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
        txtTitulo.text("Registrar una Nueva Sancion");
        btnBuscarPrestamo.removeAttr("disabled");
        btnLimpiarForm.trigger("click");
    })
    .on("click", "#btnRegistrarSancion", function () {
        let formData = new FormData(frmSancion.get(0));
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
                tblSanciones.draw();
            },
        });
    })
    .on("click", "#btnEditarSancion", function () {
        let formData = new FormData(frmSancion.get(0));
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
                tblSanciones.draw();
            },
        });
    })
    .on("click", "#btnBuscarLector", function () {
        modalBuscarLector.modal("show");
    });

$.ajax({
    url: url.select2,
    data: {
        campos: ["estados_de_las_sanciones", "tipos_de_sanciones"],
    },
    success: function (data) {
        frmCampos[`estado_de_la_sancion_id`]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado del Sancion",
                data: data["estados_de_las_sanciones"],
            })
            .val(null)
            .trigger("change");
        frmCampos[`tipo_de_sancion_id`]
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
