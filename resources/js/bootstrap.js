window._ = require("lodash");

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require("jquery");
    require("overlayscrollbars");
    require("../../vendor/almasaeed2010/adminlte/dist/js/adminlte");
    require("../../public/vendor/bootstrap/js/bootstrap.bundle.js");

    //Plugins Descargados
    //Plugin Pace
    require("../../public/vendor/pace-progress/pace");
    //Plugin Select2
    require("../../public/vendor/select2/js/select2.full");
    require("../../public/vendor/select2/js/i18n/es");
    //Plugin BootstrapSwitch
    require("../../public/vendor/bootstrap-switch/js/bootstrap-switch");
    //Plugin BootstrapSelect
    require("../../public/vendor/bootstrap-select/dist/js/bootstrap-select");
    require("../../public/vendor/bootstrap-select/dist/js/i18n/defaults-es_ES");
    //Plugin BsCustomFileInput
    window.bsCustomFileInput = require("../../public/vendor/bs-custom-file-input/bs-custom-file-input");
    //Plugin Sweetalert2
    window.Swal = require("../../public/vendor/sweetalert2/sweetalert2");
    //Plugin Datatables
    require("../../public/vendor/datatables/js/jquery.dataTables");
    require("../../public/vendor/datatables/js/dataTables.bootstrap4");
    //Plugin Datatables
    require("../../public/vendor/datatables-plugins/buttons/js/dataTables.buttons");
    require("../../public/vendor/datatables-plugins/buttons/js/buttons.bootstrap4");
    require("../../public/vendor/datatables-plugins/buttons/js/buttons.colVis");
    require("../../public/vendor/datatables-plugins/buttons/js/buttons.flash");
    require("../../public/vendor/datatables-plugins/buttons/js/buttons.html5");
    require("../../public/vendor/datatables-plugins/buttons/js/buttons.print");
    window.jsZip = require("../../public/vendor/datatables-plugins/jszip/jszip");
    require("../../public/vendor/datatables-plugins/pdfmake/pdfmake");
    require("../../public/vendor/datatables-plugins/pdfmake/vfs_fonts");
    require("../../public/vendor/datatables-plugins/responsive/js/dataTables.responsive");
    require("../../public/vendor/datatables-plugins/responsive/js/responsive.bootstrap4");
    //Plugin DatatablesPlugins
    //Plugin Moment
    //window.moment = require("../../public/vendor/moment/moment-with-locales");
    //Plugin DateRangePicker
    //require("../../public/vendor/daterangepicker/daterangepicker");
    //Plugin TempusDominusBs4
    //require("../../public/vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4");
    //Plugin Summernote
    //require("../../public/vendor/summernote/summernote-bs4");
    //Plugin Chartjs
    //require("../../public/vendor/chart/Chart.bundle.js");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
