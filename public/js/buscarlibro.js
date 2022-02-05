const frmBuscarLibro = $(`form#frmBuscarLibro`);
const resultados = $(`#resultados`);
const frm_filtro = $(`#frm_filtro`).select2({
    theme: "bootstrap4",
    placeholder: "Seleccione el Genero"
});

const btnBuscarLibro = $("#btnBuscarLibro").on("click", function() {
    let formData = new FormData(frmBuscarLibro.get(0));
    formData.append("_method", "GET");
    $.ajax({
        url: url.buscar,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(libros) {
            if (libros.length == 0) {
                Swal.fire({
                    icon: "info",
                    text: "No se encontraron resultados"
                });
            } else {
                let html = "";
                Swal.fire({
                    icon: "success",
                    text: `${libros.length} Resultados`
                });
                $.each(libros, function(index, unLibro) {
                    html += `
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                    <div class="card">
                        <div class="card-body">
                            <img src="${
                                unLibro["imagen"]
                            }" alt="Imagen del Libro"
                                class="card-img-top img-fluid">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="float-left"><b>Titulo</b></h5>
                                            <div class="card-tools float-right">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-lg fa-minus"></i> </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h3 class="card-title">
                                                ${unLibro["titulo"]}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <p><b>Editorial:</b> ${
                                        unLibro["editorial"]
                                    }</p>
                                    <p><b>Idioma:</b> ${unLibro["idioma"]}</p>
                                    <p><b>Autor(es):</b> ${unLibro["autores"] ||
                                        ""}</p>
                                    <p><b>Subclasificacion(es):</b> ${unLibro[
                                        "sub_clasificaciones"
                                    ] || ""}</p>
                                </div>
                            </div>
                            <a type="button" href="${url.ver.replace(
                                "#",
                                unLibro["titulo_slug"]
                            )}" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in"></i> Ver detalles </a>
                        </div>
                    </div>
                </div>`;
                });
                resultados.html(html);
            }
        }
    });
});

frmBuscarLibro.on("submit", function(e) {
    e.preventDefault();
    btnBuscarLibro.trigger("click");
});
