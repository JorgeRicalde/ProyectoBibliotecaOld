const frmUsuario = $(`form#frmUsuario`);
const frmCampos = {
    id: $("#frm_id"),
    name: $("#frm_name"),
    last_name: $("#frm_last_name"),
    celular: $("#frm_celular"),
    email: $("#frm_email"),
    password: $("#frm_password"),
    dni: $("#frm_dni"),
    genero_id: $("#frm_genero_id"),
    estado_del_usuario_id: $("#frm_estado_del_usuario_id"),
    role_id: $("#frm_role_id"),
    imagen: $("#frm_imagen"),
};

const modalDetalles = $(`#modalDetallesUsuario`);
const frmDetallesUsuario = $(`form#frmDetallesUsuario`);
const frmDetallesCampos = {
    name: $("#modal_name"),
    last_name: $("#modal_last_name"),
    email: $("#modal_email"),
    celular: $("#modal_celular"),
    dni: $("#modal_dni"),
    estado_del_usuario: $("#modal_estado_del_usuario"),
    genero: $("#modal_genero"),
    rol: $("#modal_rol"),
    imagen: $("#modal_imagen"),
};

const txtTitulo = $(`#frmTitulo`);
const contenedorRegistrar = $(`#opcionesRegistrarUsuario`);
const contenedorEditar = $(`#opcionesEditarUsuario`);

const tblUsuarios = $(`#tblUsuarios`)
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
                        tblUsuarios.draw();
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
        order: [[6, "desc"]],
        columns: [
            {
                defaultContent: `<nobr><a href="#frmTitulo" class="btn btn-xs btn-default text-success mx-1 shadow btn-editar-usuario" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a><button class="btn btn-xs btn-default text-info mx-1 shadow  btn-ver-detalles-usuario" title="Detalles"><i class="fa fa-lg fa-fw fa-eye"></i></button></nobr>`,
                searchable: false,
                orderable: false,
            },
            { data: "name" },
            { data: "last_name" },
            { data: "estado_del_usuario" },
            { data: "rol" },
            { data: "dni" },
            { data: "fecha_registro" },
        ],
    })
    .on("draw.dt", function () {
        tblUsuarios.columns.adjust();
    });

const btnLimpiarForm = $("#btnLimpiarForm").on("click", function () {
    frmUsuario.get(0).reset();
    frmCampos["id"].val(null);
    frmCampos["name"].val(null);
    frmCampos["last_name"].val(null);
    frmCampos["celular"].val(null);
    frmCampos["email"].val(null);
    frmCampos["password"].val(null);
    frmCampos["dni"].val(null);
    frmCampos["genero_id"].val(null).trigger("change");
    frmCampos["estado_del_usuario_id"].val(null).trigger("change");
    frmCampos["role_id"].val(null).trigger("change");
});

$(document)
    .on("click", ".btn-editar-usuario", function (e) {
        let dataRow = tblUsuarios.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            contenedorRegistrar.addClass("d-none");
            contenedorEditar.removeClass("d-none");
            txtTitulo.text("Editar Usuario");
            frmCampos["id"].val(dataRow["id"]);
            frmCampos["name"].val(dataRow["name"]);
            frmCampos["last_name"].val(dataRow["last_name"]);
            frmCampos["celular"].val(dataRow["celular"]);
            frmCampos["email"].val(dataRow["email"]);
            frmCampos["password"].val(null);
            frmCampos["dni"].val(dataRow["dni"]);
            frmCampos["genero_id"].val(dataRow["genero_id"]).trigger("change");
            frmCampos["estado_del_usuario_id"]
                .val(dataRow["estado_del_usuario_id"])
                .trigger("change");
            frmCampos["role_id"].val(dataRow["role_id"]).trigger("change");
        }
    })
    .on("click", ".btn-ver-detalles-usuario", function () {
        frmDetallesUsuario.get(0).reset();
        let dataRow = tblUsuarios.row($(this).closest("tr")).data();
        if (Boolean(dataRow)) {
            frmDetallesCampos["name"].val(dataRow["name"]);
            frmDetallesCampos["last_name"].val(dataRow["last_name"]);
            frmDetallesCampos["email"].val(dataRow["email"]);
            frmDetallesCampos["celular"].val(dataRow["celular"]);
            frmDetallesCampos["dni"].val(dataRow["dni"]);
            frmDetallesCampos["estado_del_usuario"].val(
                dataRow["estado_del_usuario"]
            );
            frmDetallesCampos["genero"].val(dataRow["genero"]);
            frmDetallesCampos["rol"].val(dataRow["rol"]);
            frmDetallesCampos["imagen"].attr("src", dataRow["imagen"]);
            modalDetalles.modal(`show`);
        }
    })
    .on("click", "#btnCancelarEdicion", function () {
        contenedorEditar.addClass("d-none");
        contenedorRegistrar.removeClass("d-none");
        txtTitulo.text("Registrar un Nuevo Usuario");
        btnLimpiarForm.trigger("click");
    })
    .on("click", "#btnRegistrarUsuario", function () {
        let formData = new FormData(frmUsuario.get(0));
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
                tblUsuarios.draw();
            },
        });
    })
    .on("click", "#btnEditarUsuario", function () {
        let formData = new FormData(frmUsuario.get(0));
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
                tblUsuarios.draw();
            },
        });
    });

$.ajax({
    url: url.select2,
    data: {
        campos: ["generos", "estados_de_los_usuarios", "roles"],
    },
    success: function (data) {
        frmCampos["genero_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Genero",
                data: data["generos"],
            })
            .val(null)
            .trigger("change");
        frmCampos["estado_del_usuario_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Estado del Usuario",
                data: data["estados_de_los_usuarios"],
            })
            .val(null)
            .trigger("change");
        frmCampos["role_id"]
            .select2({
                theme: "bootstrap4",
                placeholder: "Seleccione el Rol",
                data: data["roles"],
            })
            .val(null)
            .trigger("change");
    },
});

btnLimpiarForm.trigger("click");
