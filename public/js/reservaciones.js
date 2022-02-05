const frmReserva = $(`form#frmReserva`);
const frmCampos = {
    id: $("#frm_id"),
    ejemplar_id: $("#frm_ejemplar_id"),
    libro: $("#frm_libro"),
    dias_de_prestamo: $("#frm_dias_de_prestamo"),
    dias_de_prestamo_text: $("#frm_dias_de_prestamo_text"),
    estado_fisico_del_ejemplar_id: $("#frm_estado_fisico_del_ejemplar_id"),
};

const modalDetalles = $(`#modalDetallesReserva`);
const frmDetallesReserva = $(`form#frmDetallesReserva`);
const frmDetallesCampos = {
    libro: $("#modal_libro"),
    dias_de_prestamo_text: $("#modal_dias_de_prestamo_text"),
    fecha_de_reservacion: $("#modal_fecha_de_reservacion"),
};

const txtTitulo = $(`#frmTitulo`);
const contenedorRegistrar = $(`#opcionesRegistrarReserva`);
const contenedorEditar = $(`#opcionesEditarReserva`);

const modalBuscarEjemplar = $(`#modalBuscarEjemplar`).on(
    "hidden.bs.modal",
    function () {
        slcLibro.val(null).trigger("change");
        if (tblEjemplares.ajax.url(url.limpiar).data().count() > 0) {
            tblEjemplares.draw();
        }
    }
);

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
                {
                    text: '<i class="fas fa-sync-alt"></i>',
                    className: "btn-default",
                    action: function () {
                        tblReservas.draw();
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
        order: [[3, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><a href="#frmTitulo" class="btn btn-xs btn-default text-success mx-1 shadow btn-editar-reservacion" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a><button class="btn btn-xs btn-default text-info mx-1 shadow  btn-ver-detalles-reservacion" title="Detalles"><i class="fa fa-lg fa-fw fa-eye"></i></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "libro" },
            { data: "dias_de_prestamo", render: addTextDays },
            { data: "fecha_de_reservacion" },
        ],
    })
    .on("draw.dt", function () {
        tblReservas.columns.adjust();
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

const btnLimpiarForm = $("#btnLimpiarForm").on("click", function () {
    frmReserva.get(0).reset();
    frmCampos["id"].val(null);
    frmCampos["ejemplar_id"].val(null);
    frmCampos["libro"].val(null);
    frmCampos["dias_de_prestamo"].val(null);
    frmCampos["dias_de_prestamo_text"].val(null);
    frmCampos["estado_fisico_del_ejemplar_id"].val(null).trigger("change");
});

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

$(document)
    .on("click", ".btn-editar-reservacion", function (e) {
        let dataRow = tblReservas.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            contenedorRegistrar.addClass("d-none");
            contenedorEditar.removeClass("d-none");
            txtTitulo.text("Editar Reserva");
            frmCampos["id"].val(dataRow["id"]);
            frmCampos["ejemplar_id"].val(dataRow["ejemplar_id"]);
            frmCampos["libro"].val(dataRow["libro"]);
            frmCampos["dias_de_prestamo"].val(dataRow["dias_de_prestamo"]);
            frmCampos["dias_de_prestamo_text"].val(
                addTextDays(dataRow["dias_de_prestamo"])
            );
            frmCampos["estado_fisico_del_ejemplar_id"]
                .val(stringToArray(dataRow["estado_fisico_del_ejemplar_id"]))
                .trigger("change");
        }
    })
    .on("click", ".btn-ver-detalles-reservacion", function () {
        frmDetallesReserva.get(0).reset();
        let dataRow = tblReservas.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmDetallesCampos["libro"].val(dataRow["libro"]);
            frmDetallesCampos["dias_de_prestamo_text"].val(
                addTextDays(dataRow["dias_de_prestamo"])
            );
            frmDetallesCampos["fecha_de_reservacion"].val(
                dataRow["fecha_de_reservacion"]
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
    .on("click", "#btnCancelarEdicion", function () {
        contenedorEditar.addClass("d-none");
        contenedorRegistrar.removeClass("d-none");
        txtTitulo.text("Registrar una Nueva Reserva");
        btnLimpiarForm.trigger("click");
    })
    .on("click", "#btnRegistrarReserva", function () {
        let formData = new FormData(frmReserva.get(0));
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
                tblReservas.draw();
            },
        });
    })
    .on("click", "#btnEditarReserva", function () {
        let formData = new FormData(frmReserva.get(0));
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
                tblReservas.draw();
            },
        });
    })
    .on("click", "#btnBuscarLibro", function () {
        modalBuscarEjemplar.modal("show");
    })
    .on("click", "#btnIncrementar", function () {
        let actual = parseInt(frmCampos["dias_de_prestamo"].val());
        actual = actual ? actual + 1 : 1;
        if (actual >= 1 && actual <= 14) {
            frmCampos["dias_de_prestamo"].val(actual);
            frmCampos["dias_de_prestamo_text"].val(addTextDays(actual));
        }
    })
    .on("click", "#btnDisminuir", function () {
        let actual = parseInt(frmCampos["dias_de_prestamo"].val());
        actual = actual ? actual - 1 : 1;
        if (actual >= 1 && actual <= 14) {
            frmCampos["dias_de_prestamo"].val(actual);
            frmCampos["dias_de_prestamo_text"].val(addTextDays(actual));
        }
    });

$.ajax({
    url: url.estados_fisicos_de_los_ejemplares,
    success: function (data) {
        frmCampos["estado_fisico_del_ejemplar_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado Fisico de la Ejemplar",
                data: data,
            })
            .val(null)
            .trigger("change");
    },
});

btnLimpiarForm.trigger("click");
