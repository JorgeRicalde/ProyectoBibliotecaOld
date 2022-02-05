const frmHistorialPrestamo = $(`form#frmHistorialPrestamo`);
const resultados = $("#resultados");
const frmCampos = {
    filtro: $("#frm_filtro"),
    fecha_desde: $("#frm_fecha_desde"),
    fecha_hasta: $("#frm_fecha_hasta"),
};

frmCampos["filtro"]
    .select2({
        theme: "bootstrap4",
        placeholder: "Seleccione un Filtro",
        data: [
            {
                id: "0",
                text: "Fecha Personalizada",
                cambiarFechas: function () {},
            },
            {
                id: "1",
                text: "3 Dias",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(3, "days").format("YYYY-MM-DD")
                    );
                },
            },
            {
                id: "2",
                text: "1 Semana",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(7, "days").format("YYYY-MM-DD")
                    );
                },
            },
            {
                id: "3",
                text: "2 Semanas",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(14, "days").format("YYYY-MM-DD")
                    );
                },
            },
            {
                id: "4",
                text: "1 Mes",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(1, "months").format("YYYY-MM-DD")
                    );
                },
            },
            {
                id: "5",
                text: "2 Meses",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(2, "months").format("YYYY-MM-DD")
                    );
                },
            },
            {
                id: "6",
                text: "3 Meses",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(3, "months").format("YYYY-MM-DD")
                    );
                },
            },
            {
                id: "7",
                text: "6 Meses",
                cambiarFechas: function () {
                    let hoy = moment();
                    frmCampos["fecha_hasta"].val(hoy.format("YYYY-MM-DD"));
                    frmCampos["fecha_desde"].val(
                        hoy.subtract(6, "months").format("YYYY-MM-DD")
                    );
                },
            },
        ],
    })
    .on("select2:select", function ({ params }) {
        let data = params.data;
        if (Boolean(data)) {
            data.cambiarFechas();
        } else {
            Swal.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Seleccione un Filtro",
            });
        }
    });

$(document).on("click", "#btnFiltrar", function () {
    let formData = new FormData(frmHistorialPrestamo.get(0));
    formData.append("_method", "GET");
    $.ajax({
        url: url.historial,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (historiales) {
            let html = ``;
            for (let unHistorial of historiales) {
                html += `
                <div class="col-12 col-xl-6">
                    <div class="card card-lightblue">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="float-left"><b>Prestamo: ${formatPrestamoCodigo(
                                        unHistorial["id"]
                                    )}
                                    </br>${
                                        unHistorial["fecha_prestamo"]
                                    }</b></h5>
                                    <h4 class="float-right"><b class="badge badge-success">${
                                        unHistorial["estado_del_prestamo"]
                                    }</b></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="col-12 col-md-5 align-self-center">
                                <img src="${unHistorial["imagen"]}"
                                    alt="Imagen del Libro" class="card-img-top img-fluid">
                            </div>
                            <div class="col-12 col-md-7 align-self-center">
                                <div class="card bg-gradient-primary">
                                    <div class="card-body">
                                        <p><b>Libro:</b> ${
                                            unHistorial["libro"]
                                        }</p>
                                        <p><b>Dias de Prestamo:</b> ${addTextDays(
                                            unHistorial["dias_de_prestamo"]
                                        )}</p>
                                        <p><b>Fecha Devolucion:</b> ${
                                            unHistorial["fecha_devolucion"] ||
                                            "No Devuelto"
                                        }</p>
                                        <p><b>Bibliotecario:</b> ${
                                            unHistorial["bibliotecario"]
                                        }</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            }
            resultados.html(html);
        },
    });
});
