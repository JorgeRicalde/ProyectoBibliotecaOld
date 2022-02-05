const frmInfoLibro = $(`form#frmInfoLibro`);
const frmCampos = {
    id: $("#frm_id"),
    imagen: $("#frm_imagen"),
    titulo: $("#frm_titulo"),
    editorial: $("#frm_editorial"),
    idioma: $("#frm_idioma"),
    anyo_de_lanzamiento: $("#frm_anyo_de_lanzamiento"),
    autores: $("#frm_autores"),
    sub_clasificaciones: $("#frm_sub_clasificaciones"),
};

const modalRegistrarReserva = $(`#modalRegistrarReserva`);
const frmRegistraReserva = $(`form#frmRegistraReserva`);
const frmRegistraReservaCampos = {
    ejemplar_id: $("#frm_ejemplar_id"),
    dias_de_prestamo: $("#frm_dias_de_prestamo"),
    dias_de_prestamo_text: $("#frm_dias_de_prestamo_text"),
};

const modalRegistrarEjemplar = $(`#modalRegistrarEjemplar`);
const frmRegistrarEjemplar = $(`form#frmRegistrarEjemplar`);
const frmRegistrarEjemplarCampos = {
    libro_id: $("#frm_libro_id"),
    estado_del_ejemplar_id: $("#frm_estado_del_ejemplar_id"),
    estado_fisico_del_ejemplar_id: $("#frm_estado_fisico_del_ejemplar_id"),
};

const modalEditarEjemplar = $(`#modalEditarEjemplar`);
const frmEditarEjemplar = $(`form#frmEditarEjemplar`);
const frmEditarEjemplarCampos = {
    id: $("#modal_id"),
    estado_del_ejemplar_id: $("#modal_estado_del_ejemplar_id"),
    estado_fisico_del_ejemplar_id: $("#modal_estado_fisico_del_ejemplar_id"),
};

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
                {
                    text: '<i class="fas fa-sync-alt"></i>',
                    className: "btn-default",
                    action: function () {
                        tblEjemplares.draw();
                    },
                },
            ],
        },
        processing: true,
        serverSide: true,
        searchDelay: 1000,
        ajax: {
            url: url.datatable.replace("#", "0"),
            type: "POST",
            data: formatDataOfDataTable,
            beforeSend: function () {
                return Boolean(frmCampos["id"].text());
            },
        },
        order: [[1, "desc"]],
        columns: [
            {
                defaultContent: `<nobr>${
                    permisos["ejemplar_update"]
                        ? `<button class="btn btn-xs btn-default text-success mx-1 shadow btn-editar-ejemplar" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></button>`
                        : ""
                }${
                    permisos["reservacion_store"]
                        ? `<button class="btn btn-xs btn-default text-info mx-1 shadow btn-reservar-ejemplar" title="Reservar"><i class="fa fa-lg fa-fw fa-book"></i></button>`
                        : ""
                }</nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "libro" },
            { data: "estado_del_ejemplar" },
            { data: "estado_fisico_del_ejemplar" },
        ],
    })
    .on("draw.dt", function () {
        tblEjemplares.columns.adjust();
    });

$(document)
    .on("click", ".btn-editar-ejemplar", function () {
        let dataRow = tblEjemplares.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmEditarEjemplarCampos["id"].val(dataRow["id"]);
            frmEditarEjemplarCampos["estado_del_ejemplar_id"]
                .val(dataRow["estado_del_ejemplar_id"])
                .trigger("change");
            frmEditarEjemplarCampos["estado_fisico_del_ejemplar_id"]
                .val(stringToArray(dataRow["estado_fisico_del_ejemplar_id"]))
                .trigger("change");
            modalEditarEjemplar.modal(`show`);
        }
    })
    .on("click", ".btn-reservar-ejemplar", function () {
        let dataRow = tblEjemplares.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmRegistraReservaCampos["ejemplar_id"].val(dataRow["id"]);
            frmRegistraReservaCampos["dias_de_prestamo"].val(null);
            frmRegistraReservaCampos["dias_de_prestamo_text"].val(null);
            modalRegistrarReserva.modal("show");
        }
    })
    .on("click", "#btnIncrementar", function () {
        let actual = parseInt(
            frmRegistraReservaCampos["dias_de_prestamo"].val()
        );
        actual = actual ? actual + 1 : 1;
        if (actual >= 1 && actual <= 14) {
            frmRegistraReservaCampos["dias_de_prestamo"].val(actual);
            frmRegistraReservaCampos["dias_de_prestamo_text"].val(
                addTextDays(actual)
            );
        }
    })
    .on("click", "#btnDisminuir", function () {
        let actual = parseInt(
            frmRegistraReservaCampos["dias_de_prestamo"].val()
        );
        actual = actual ? actual - 1 : 1;
        if (actual >= 1 && actual <= 14) {
            frmRegistraReservaCampos["dias_de_prestamo"].val(actual);
            frmRegistraReservaCampos["dias_de_prestamo_text"].val(
                addTextDays(actual)
            );
        }
    })
    .on("click", "#btnModalRegistrarEjemplar", function () {
        frmRegistrarEjemplarCampos["libro_id"].val(frmCampos["id"].text());
        frmRegistrarEjemplarCampos["estado_del_ejemplar_id"]
            .val(1)
            .trigger("change");
        frmRegistrarEjemplarCampos["estado_fisico_del_ejemplar_id"]
            .val(1)
            .trigger("change");
        modalRegistrarEjemplar.modal(`show`);
    })
    .on("click", "#btnEditarEjemplar", function () {
        let formData = new FormData(frmEditarEjemplar.get(0));
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
                tblEjemplares.draw();
                modalEditarEjemplar.modal(`hide`);
            },
        });
    })
    .on("click", "#btnRegistrarEjemplar", function () {
        let formData = new FormData(frmRegistrarEjemplar.get(0));
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
                tblEjemplares.draw();
                modalRegistrarEjemplar.modal(`hide`);
            },
        });
    })
    .on("click", "#btnRegistrarReserva", function () {
        let formData = new FormData(frmRegistraReserva.get(0));
        formData.append("_method", "POST");
        $.ajax({
            url: url.reservacion,
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
                tblEjemplares.draw();
                modalRegistrarReserva.modal(`hide`);
            },
        });
    });

$.ajax({
    url: url.mostrar,
    success: function (data) {
        frmCampos["id"].text(data["id"]);
        frmCampos["imagen"].attr("src", data["imagen"]);
        frmCampos["titulo"].text(data["titulo"]);
        frmCampos["editorial"].text(data["editorial"]);
        frmCampos["idioma"].text(data["idioma"]);
        frmCampos["anyo_de_lanzamiento"].text(data["anyo_de_lanzamiento"]);
        frmCampos["autores"].text(data["autores"]);
        frmCampos["sub_clasificaciones"].text(data["sub_clasificaciones"]);
        tblEjemplares.ajax.url(url.datatable.replace("#", data["id"])).load();
    },
});

$.ajax({
    url: url.select2,
    data: {
        campos: [
            "estados_de_los_ejemplares",
            "estados_fisicos_de_los_ejemplares",
        ],
    },
    success: function (data) {
        $(`.states-copie`)
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado de la Ejemplar",
                data: data["estados_de_los_ejemplares"],
            })
            .val(null)
            .trigger("change");
        $(`.physical-states-copy`)
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado Fisico de la Ejemplar",
                data: data["estados_fisicos_de_los_ejemplares"],
            })
            .val(null)
            .trigger("change");
    },
});
