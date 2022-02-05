const meses = [
    { id: "1", text: "Enero" },
    { id: "2", text: "Febrero" },
    { id: "3", text: "Marzo" },
    { id: "4", text: "Abril" },
    { id: "5", text: "Mayo" },
    { id: "6", text: "Junio" },
    { id: "7", text: "Julio" },
    { id: "8", text: "Agosto" },
    { id: "9", text: "Setiembre" },
    { id: "10", text: "Octubre" },
    { id: "11", text: "Noviembre" },
    { id: "12", text: "Diciembre" },
];

const trimestres = [
    { id: "1", text: "1er. Trimestre" },
    { id: "2", text: "2do. Trimestre" },
    { id: "3", text: "3er. Trimestre" },
    { id: "4", text: "4to. Trimestre" },
];

const anyos = [
    { id: "2021", text: "2021" },
    { id: "2020", text: "2020" },
    { id: "2019", text: "2019" },
    { id: "2018", text: "2018" },
    { id: "2017", text: "2017" },
];

const slcMesTrimestre = $("#frm_mes_trimestre").select2({
    theme: "bootstrap4",
    placeholder: "Seleccione un Filtro",
    data: meses,
});

const slcAnyo = $("#frm_anyo").select2({
    theme: "bootstrap4",
    placeholder: "Seleccione un Año",
    data: anyos,
});

const slcFiltro = $("#frm_filtro")
    .select2({
        theme: "bootstrap4",
        placeholder: "Seleccione un Filtro",
        data: [
            {
                id: "1",
                text: "Mes y Año",
                url: url.mes,
                cambiarOpciones: function () {
                    tblReportePrestamos.ajax.url(this.url);
                    slcMesTrimestre.empty().select2("destroy").select2({
                        theme: "bootstrap4",
                        placeholder: "Seleccione un Mes",
                        data: meses,
                    });
                },
            },
            {
                id: "2",
                text: "Trimestre y Año",
                url: url.trimestre,
                cambiarOpciones: function () {
                    tblReportePrestamos.ajax.url(this.url);
                    slcMesTrimestre.empty().select2("destroy").select2({
                        theme: "bootstrap4",
                        placeholder: "Seleccione un Trimestre",
                        data: trimestres,
                    });
                },
            },
        ],
    })
    .on("select2:select", function ({ params }) {
        let data = params.data;
        if (Boolean(data)) {
            data.cambiarOpciones();
        } else {
            Swal.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Seleccione un Filtro",
            });
        }
    });

const tblReportePrestamos = $(`#tblReportePrestamos`)
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
                    extend: "print",
                    className: "btn-default",
                    text: '<i class="fas fa-fw fa-lg fa-print"></i>',
                    titleAttr: "Imprimir",
                    title: "Reporte de Prestamos",
                    exportOptions: {
                        columns: ":not([dt-no-export])",
                    },
                },
                {
                    extend: "csv",
                    className: "btn-default",
                    text: '<i class="fas fa-fw fa-lg fa-file-csv text-primary"></i>',
                    titleAttr: "Exportar a CSV",
                    exportOptions: {
                        columns: ":not([dt-no-export])",
                    },
                },
                {
                    extend: "excel",
                    className: "btn-default",
                    text: '<i class="fas fa-fw fa-lg fa-file-excel text-success"></i>',
                    titleAttr: "Exportar a Excel",
                    title: "Reporte de Prestamos",
                    exportOptions: {
                        columns: ":not([dt-no-export])",
                    },
                },
                {
                    extend: "pdf",
                    download: "open",
                    className: "btn-default",
                    text: '<i class="fas fa-fw fa-lg fa-file-pdf text-danger"></i>',
                    titleAttr: "Exportar a PDF",
                    title: "Reporte de Prestamos",
                    exportOptions: {
                        columns: ":not([dt-no-export])",
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = ["50%", "25%", "25%"];
                        doc.watermark = dataTableCustomize.watermark;
                        doc.styles.title = dataTableCustomize.title;
                        doc.styles.tableHeader = dataTableCustomize.tableHeader;
                        doc.styles.tableFooter = dataTableCustomize.tableFooter;
                        doc.content[1].layout = dataTableCustomize.layout;
                        doc.footer = dataTableCustomize.footer;

                        doc.styles.tableBodyOdd.alignment =
                            dataTableCustomize.alignmentOdd;
                        doc.styles.tableBodyEven.alignment =
                            dataTableCustomize.alignmentEven;
                        doc.styles.tableBodyOdd.fillColor =
                            dataTableCustomize.fillColorOdd;
                        doc.styles.tableBodyEven.fillColor =
                            dataTableCustomize.fillColorEven;
                    },
                },
            ],
        },
        ajax: {
            url: url.mes,
            type: "POST",
            data: function (params) {
                params["_method"] = "GET";
                params["anyo"] = slcAnyo.val();
                params["mes"] = slcMesTrimestre.val();
                params["trimestre"] = slcMesTrimestre.val();
                return params;
            },
            dataSrc: "",
        },
        order: [[2, "desc"]],
        columns: [
            { data: "libro" },
            { data: "cantidad_de_ejemplares" },
            { data: "cantidad_de_prestamos" },
        ],
    })
    .on("draw.dt", function () {
        tblReportePrestamos.columns.adjust();
    });

$(document).on("click", "#btnFiltrar", function () {
    tblReportePrestamos.ajax.reload();
});
