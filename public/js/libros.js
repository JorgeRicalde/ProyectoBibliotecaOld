const frmLibro = $(`form#frmLibro`);
const frmCampos = {
    id: $("#frm_id"),
    titulo: $("#frm_titulo"),
    anyo_de_lanzamiento: $("#frm_anyo_de_lanzamiento"),
    cantidad_ejemplares: $("#frm_cantidad_ejemplares"),
    idioma_id: $("#frm_idioma_id"),
    editorial_id: $("#frm_editorial_id"),
    autor_id: $("#frm_autor_id"),
    sub_clasificacion_id: $("#frm_sub_clasificacion_id"),
    imagen: $("#frm_imagen"),
};
const modalDetalles = $(`#modalDetallesLibro`);
const frmDetallesLibro = $(`form#frmDetallesLibro`);
const frmDetallesCampos = {
    titulo: $("#modal_titulo"),
    sub_clasificaciones: $("#modal_sub_clasificaciones"),
    autores: $("#modal_autores"),
    anyo_de_lanzamiento: $("#modal_anyo_de_lanzamiento"),
    idioma: $("#modal_idioma"),
    editorial: $("#modal_editorial"),
    imagen: $("#modal_imagen"),
};

const txtTitulo = $(`#frmTitulo`);
const contenedorRegistrar = $(`#opcionesRegistrarLibro`);
const contenedorEditar = $(`#opcionesEditarLibro`);
const divanyoLanzamiento = $(".anyo-lanzamiento");
const divCantidadEjemplars = $(".cantidad-ejemplares");

const tblLibros = $(`#tblLibros`)
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
                        tblLibros.draw();
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
                defaultContent: `<nobr><a href="#frmTitulo" class="btn btn-xs btn-default text-success mx-1 shadow btn-editar-libro" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a><button class="btn btn-xs btn-default text-info mx-1 shadow  btn-ver-detalles-libro" title="Detalles"><i class="fa fa-lg fa-fw fa-eye"></i></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "titulo" },
            { data: "anyo_de_lanzamiento" },
            { data: "idioma" },
            { data: "editorial" },
            { data: "fecha_registro" },
        ],
    })
    .on("draw.dt", function () {
        tblLibros.columns.adjust();
    });

const btnLimpiarForm = $("#btnLimpiarForm").on("click", function () {
    frmLibro.get(0).reset();
    frmCampos["id"].val(null);
    frmCampos["titulo"].val(null);
    frmCampos["cantidad_ejemplares"].val(null);
    frmCampos["anyo_de_lanzamiento"].val(null);
    frmCampos["imagen"].val(null);
    frmCampos["editorial_id"].val(null).trigger("change");
    frmCampos["idioma_id"].val(null).trigger("change");
    frmCampos["autor_id"].val(null).trigger("change");
    frmCampos["sub_clasificacion_id"].val(null).trigger("change");
});

$(document)
    .on("click", ".btn-editar-libro", function () {
        let dataRow = tblLibros.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            contenedorRegistrar.addClass("d-none");
            contenedorEditar.removeClass("d-none");
            divanyoLanzamiento.removeClass("col-lg-3").addClass("col-lg-6");
            divCantidadEjemplars.addClass("d-none");
            txtTitulo.text("Editar Libro");
            frmCampos["id"].val(dataRow["id"]);
            frmCampos["titulo"].val(dataRow["titulo"]);
            frmCampos["anyo_de_lanzamiento"].val(
                dataRow["anyo_de_lanzamiento"]
            );
            frmCampos["idioma_id"].val(dataRow["idioma_id"]).trigger("change");
            frmCampos["editorial_id"]
                .val(dataRow["editorial_id"])
                .trigger("change");
            frmCampos["autor_id"]
                .val(stringToArray(dataRow["autor_id"]))
                .trigger("change");
            frmCampos["sub_clasificacion_id"]
                .val(stringToArray(dataRow["sub_clasificacion_id"]))
                .trigger("change");
        }
    })
    .on("click", ".btn-ver-detalles-libro", function () {
        frmDetallesLibro.get(0).reset();
        let dataRow = tblLibros.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmDetallesCampos["titulo"].val(dataRow["titulo"]);
            frmDetallesCampos["sub_clasificaciones"].val(
                dataRow["sub_clasificaciones"]
            );
            frmDetallesCampos["autores"].val(dataRow["autores"]);
            frmDetallesCampos["anyo_de_lanzamiento"].val(
                dataRow["anyo_de_lanzamiento"]
            );
            frmDetallesCampos["idioma"].val(dataRow["idioma"]);
            frmDetallesCampos["editorial"].val(dataRow["editorial"]);
            frmDetallesCampos["imagen"].attr("src", dataRow["imagen"]);
            modalDetalles.modal(`show`);
        }
    })
    .on("click", "#btnRegistrarLibro", function () {
        let formData = new FormData(frmLibro.get(0));
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
                tblLibros.draw();
            },
        });
    })
    .on("click", "#btnEditarLibro", function () {
        let formData = new FormData(frmLibro.get(0));
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
                tblLibros.draw();
            },
        });
    })
    .on("click", "#btnCancelarEdicion", function () {
        contenedorEditar.addClass("d-none");
        contenedorRegistrar.removeClass("d-none");
        divanyoLanzamiento.removeClass("col-lg-6").addClass("col-lg-3");
        divCantidadEjemplars.removeClass("d-none");
        txtTitulo.text("Registrar un Nuevo Libro");
        btnLimpiarForm.trigger("click");
    });

$.ajax({
    url: url.select2,
    data: {
        campos: ["idiomas", "editoriales", "autores", "sub_clasificaciones"],
    },
    success: function (data) {
        frmCampos["idioma_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Idioma",
                data: data["idiomas"],
            })
            .val(null)
            .trigger("change");
        frmCampos["editorial_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione la Editorial",
                data: data["editoriales"],
            })
            .val(null)
            .trigger("change");
        frmCampos["autor_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione los autores",
                data: data["autores"],
            })
            .val(null)
            .trigger("change");
        frmCampos["sub_clasificacion_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione las Sub Clasificaciones",
                data: data["sub_clasificaciones"],
            })
            .val(null)
            .trigger("change");
    },
});

btnLimpiarForm.trigger("click");
