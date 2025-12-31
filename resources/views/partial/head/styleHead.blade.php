<!--begin::Page Vendors Styles(used by this page) -->
<link href="{{ asset('vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/pages/invoices/invoice-2.css') }}" rel="stylesheet" type="text/css" />

<!--begin:: Global Mandatory Vendors -->
<link href="{{ asset('vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />

<!--begin:: Global Optional Vendors -->
<link href="{{ asset('vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->
<link href="{{ asset('vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Handsontable CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@14.3.0/dist/handsontable.min.css">

<!--begin::Global Theme Styles(used by all pages) -->
<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<!--begin::Layout Skins(used by all pages) -->
<link href="{{ asset('css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />

<!--end::Layout Skins -->
<link rel="shortcut icon" href="{{ asset('media/logos/logotebet.png') }}" />

{{-- THIS PLUGIN MAKE ALL DEFAULT FORMAT WAS REMOVE --}}
{{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Custom Style for Schedule Activity Next Month Page -->
<style>
    .body-schedule .containers {
        max-width: 100%;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .body-schedule .header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .body-schedule .header h1 {
        font-size: 2em;
        margin-bottom: 10px;
    }

    .body-schedule .month-info {
        font-size: 1.2em;
        font-weight: 600;
        margin-top: 10px;
        background: rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 20px;
        display: inline-block;
    }

    .body-schedule .controls {
        padding: 20px 30px;
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .body-schedule .search-box {
        flex: 1;
        min-width: 200px;
    }

    .body-schedule .search-box input {
        width: 100%;
        padding: 12px 20px;
        border: 2px solid #dee2e6;
        border-radius: 25px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .body-schedule .search-box input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .body-schedule .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .body-schedule .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .body-schedule .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .body-schedule .btn-info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 8px 16px;
        font-size: 12px;
    }

    .body-schedule .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
    }

    .body-schedule .table-wrapper {
        overflow-x: auto;
        /* padding: 0 30px 30px; */
    }

    .body-schedule table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .body-schedule thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .body-schedule th {
        padding: 15px 10px;
        text-align: center;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.5px;
        min-width: 80px;
    }

    .body-schedule th:first-child {
        text-align: left;
        min-width: 150px;
        position: sticky;
        left: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: 10;
    }

    .body-schedule th:last-child {
        min-width: 100px;
    }

    .body-schedule th.date-header {
        padding: 15px 10px;
    }

    .body-schedule th.date-header .day-name {
        font-size: 11px;
        opacity: 0.9;
        font-weight: 400;
        display: block;
        margin-bottom: 3px;
    }

    .body-schedule th.date-header .date-number {
        font-size: 18px;
        font-weight: 700;
        display: block;
    }

    .body-schedule tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s;
        cursor: pointer;
    }

    .body-schedule tbody tr:hover {
        background: #f8f9fa;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .body-schedule td {
        padding: 15px 10px;
        color: #495057;
        text-align: center;
    }

    .body-schedule td:first-child {
        text-align: left;
        font-weight: 600;
        position: sticky;
        left: 0;
        background: white;
        z-index: 5;
    }

    .body-schedule tbody tr:hover td:first-child {
        background: #f8f9fa;
    }

    .body-schedule .cell-data {
        min-height: 30px;
        display: flex;
        align-items: center;
        justify-content: left;
        padding: 5px;
        border-radius: 5px;
        width: 100px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .body-schedule .cell-filled {
        margin: 2px 0;
        background: #d4edda;
        color: #155724;
        font-weight: 600;
    }

    .body-schedule .cell-empty {
        color: #dee2e6;
    }

    .body-schedule .weekend {
        background: #fa9797ff !important;
    }

    .body-schedule .loading {
        text-align: center;
        padding: 40px;
        color: #6c757d;
    }

    .body-schedule .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .body-schedule .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        padding: 20px;
        flex-wrap: wrap;
    }

    .body-schedule .page-btn {
        padding: 8px 16px;
        border: 2px solid #dee2e6;
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }

    .body-schedule .page-btn:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    .body-schedule .page-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
    }

    .body-schedule .page-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Detail Modal Custom Style */
    .body-schedule .swal2-popup {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-radius: 15px;
    }

    .details-container {
        text-align: left;
        max-height: 400px;
        overflow-y: auto;
    }

    .details-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .details-header h3 {
        margin: 0;
        font-size: 1.5em;
    }

    .details-item {
        padding: 12px;
        margin-bottom: 10px;
        border-left: 4px solid #667eea;
        background: #f8f9fa;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .details-date {
        font-weight: 600;
        color: #667eea;
    }

    .details-activity {
        background: #d4edda;
        color: #155724;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: 600;
    }

    .no-schedule {
        text-align: center;
        padding: 20px;
        color: #6c757d;
        font-style: italic;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        .body-schedule .header h1 {
            font-size: 1.5em;
        }

        .body-schedule .month-info {
            font-size: 1em;
        }

        .body-schedule .controls {
            flex-direction: column;
        }

        .body-schedule .table-wrapper {
            padding: 0 15px 15px;
        }

        .body-schedule table {
            font-size: 12px;
        }

        .body-schedule th, td {
            padding: 8px 5px;
            min-width: 60px;
        }

        .body-schedule th:first-child {
            min-width: 100px;
        }

        .body-schedule th.date-header .date-number {
            font-size: 14px;
        }

        .body-schedule th.date-header .day-name {
            font-size: 9px;
        }
    }

    @media screen and (max-width: 480px) {
        .body-schedule .containers {
            border-radius: 0;
        }

        .body-schedule .header {
            padding: 20px;
        }

        .body-schedule th, td {
            padding: 6px 3px;
            min-width: 50px;
        }
    }
</style>

<!-- Custom Style for Schedule Activity Today Page -->
<style>
    .body-schedule-today .containerss {
        max-width: 100%;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .body-schedule-today .headerss {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }

    .body-schedule-today .headerss h1 {
        font-size: 2em;
        margin-bottom: 10px;
    }

    .body-schedule-today .date-info {
        font-size: 1.2em;
        font-weight: 600;
        margin-top: 10px;
        background: rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 20px;
        display: inline-block;
    }

    .body-schedule-today .controls {
        padding: 20px 30px;
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 15px;
    }

    .body-schedule-today .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .body-schedule-today .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .body-schedule-today .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .body-schedule-today .content-wrapper {
        padding: 40px 30px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .body-schedule-today .legend-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .body-schedule-today .legend-title {
        font-size: 1.5em;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .body-schedule-today .legend-item {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s;
        cursor: pointer;
        border-left: 5px solid;
    }

    .body-schedule-today .legend-item:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .body-schedule-today .legend-checkbox {
        width: 20px;
        height: 20px;
        margin-right: 15px;
        cursor: pointer;
        display: none;
    }

    .body-schedule-today .legend-color {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        margin-right: 15px;
    }

    .body-schedule-today .legend-label {
        flex: 1;
        font-weight: 600;
        font-size: 1.2em;
        color: #f8f9fa;
    }

    .body-schedule-today .legend-count {
        font-size: 1.3em;
        font-weight: 700;
        padding: 5px 15px;
        background: white;
        border-radius: 20px;
    }

    .body-schedule-today .chart-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .body-schedule-today .chart-container {
        width: 100%;
        max-width: 700px;
        position: relative;
    }

    .body-schedule-today #activityChart {
        width: 100% !important;
        height: auto !important;
    }

    .body-schedule-today .total-info {
        text-align: center;
        padding: 5px 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .body-schedule-today .total-label {
        font-size: 1em;
        opacity: 0.9;
        margin-bottom: 5px;
    }

    .body-schedule-today .total-number {
        font-size: 3em;
        font-weight: 700;
    }

    .body-schedule-today .loading {
        text-align: center;
        padding: 60px;
        color: #6c757d;
    }

    .body-schedule-today .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #667eea;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Color Classes */
    .body-schedule-today .color-sakit { background-color: #e74c3c; border-color: #e74c3c; }
    .body-schedule-today .color-cuti { background-color: #3498db; border-color: #3498db; }
    .body-schedule-today .color-libur { background-color: #f39c12; border-color: #f39c12; }
    .body-schedule-today .color-izin { background-color: #9b59b6; border-color: #9b59b6; }
    .body-schedule-today .color-belum { background-color: #95a5a6; border-color: #95a5a6; }

    .body-schedule-today .text-sakit { color: #e74c3c; }
    .body-schedule-today .text-cuti { color: #3498db; }
    .body-schedule-today .text-libur { color: #f39c12; }
    .body-schedule-today .text-izin { color: #9b59b6; }
    .body-schedule-today .text-belum { color: #95a5a6; }

    /* Responsive Design */
    @media screen and (max-width: 968px) {
        .body-schedule-today .content-wrapper {
            grid-template-columns: 1fr;
        }

        .body-schedule-today .chart-section {
            order: -1;
        }
    }

    @media screen and (max-width: 480px) {
        .body-schedule-today .container {
            border-radius: 0;
        }

        .body-schedule-today .header {
            padding: 20px;
        }

        .body-schedule-today .header h1 {
            font-size: 1.5em;
        }

        .body-schedule-today .content-wrapper {
            padding: 20px 15px;
        }

        .body-schedule-today .legend-item {
            padding: 12px 15px;
        }

        .body-schedule-today .total-number {
            font-size: 2em;
        }
    }
</style>
