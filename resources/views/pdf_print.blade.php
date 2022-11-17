<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style type="text/css">
        body {
            font-family: 'XBRiyaz', sans-serif;
            font-size: 12px;
            text-align: right !important;
            direction: rtl;
            font-weight: bold;
            /* font-weight: bold */
            /* padding: 10px */
        }

        table {
            width: 100%;
        }

        table th {
            border-bottom: 1px solid #aaa;
            padding: 2mm;
            background-color: #f1f1f1;
        }

        .invoice-box {
            max-width: 100%;
            margin: auto;
            padding: 0;
            font-size: 12px;
            font-family: myFirstFont;
            color: #aaa;
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
            border-top: 2px solid #aaa;
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
            border: 1px solid #aaa;
            font-weight: bold
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
    <div class="invoice-box rtl">
        <table cellpadding="0" cellspacing="0" class="table">


            <tr class="information">

            </tr>

            <tr class="heading" style="text-align: center; font-size: 15px; width: 100%;">
                <th>الكود </th>
                <th> الكمية</th>
                <th> البيان</th>
                <th> الوحدة</th>
                <th>الجملة </th>
            </tr>

                <tr style="text-align: center; font-size: 14px; width: 100%">
                    <td class="num num-15">5</td>
                    <td class="num num-15">dfgfd</td>
                    <td class="num number-15">dfg</td>
                    <td class="num num-15">dfg</td>
                    <td class="num num-15">dfg</td>

                </tr>
        </table>

    </div>
</body>

</html>
