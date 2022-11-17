<html>

<head>
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">


    {{-- <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/jq.js') }}"></script>
    {{-- <script type="text/javascript" src="{{asset('js/print.js')}}"></script> --}}

    <style>
        @font-face {
            font-family: myFirstFont;
            src: url({{ asset('Khalid-Art-Bold.ttf') }});
        }

        @page {
            /* size: 80mm 80mm */
            background: url('dist/img/logo.png') no-repeat 0 0 !important;
            background-image-resize: 6;
        }
        /*
        body.receipt .sheet {
            width: 80mm;
            height: 80mm
        } */

        /* @media print {
            body.receipt {
                width: 80mm
            }
        } */

        body {
            font-family: myFirstFont;
            font-size: 10px;
            text-align: right !important;
            background: url('dist/img/logo.png') no-repeat 0 0;
            padding: 10px;

        }

        table th {
            border-bottom: 1px solid;
            padding: 2mm;
            background-color: #f1f1f1;
        }

        .invoice-box {
            background: url('dist/img/logo.png') no-repeat 0 0 !important;
            background-image-resize: 6;
            max-width: 100%;
            margin: auto;
            padding: 0;
            font-size: 12px;
            font-family: myFirstFont;
            color: #555;
        }

        .invoice-box table td {
            padding: 2px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        h5,
        p {
            margin: 2px;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }


        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: myFirstFont;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        table.table td.num {
            border: 1px solid;
            font-weight: normal
        }

        .num-15 {
            width: 15%
        }

        .number-15 {
            width: 40%
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</body>

</html>
