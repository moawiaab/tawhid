@extends('layouts.print')
@section('content')

<div class="invoice-box rtl">
    <table cellpadding="0" cellspacing="0" class="table">
        <tr class="top">
            <td colspan="5">
                <h5 style="text-align: center;">مغلق الباشمهندس المتكامل</h5>
                <p style="text-align: center; "> رقم الهاتف : 0920778096</p>
            </td>
        </tr>

        <tr class="information">
            <td colspan="5">
                <table style="font-size: 10px; width: 100%">
                    <tr>
                        <td>
                            العميل: ......<br />
                            من : {{ @$order->created_at }}<br />
                        </td>

                        <td style="text-align: left">
                            Number #: {{ @$order->id }}<br />
                            Date: {{ @$order->created_at }}<br />
                            Type: {{ @$type == 1 ? 'new' : 'printed' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading" style="text-align: center; font-size: 8px; width: 100%">
            <th>الكود </th>
            <th> الكمية</th>
            <th> البيان</th>
            <th> الوحدة</th>
            <th>الجملة </th>
        </tr>
        @forelse ($order->items as $i)
        <tr style="text-align: center; font-size: 9px; width: 100%">
            <td class="num num-15">{{ $i->pro->id }}</td>
            <td class="num num-15">{{ $i->num }}</td>
            <td class="num number-15">{{ $i->pro->name }}</td>
            <td class="num num-15">{{ ceil($i->price) }}</td>
            <td class="num num-15">{{ ceil($i->all_amount) }}</td>

        </tr>
        @empty

        @endforelse

        <tr style="text-align: center; font-size: 10px; width: 100%">
            <td class="num number" colspan="3">جملة المبلغ : </td>
            <td class="num totel" colspan="2">{{ @$order->amount }}</td>
        </tr>
    </table>
    <table style="font-size: 10px">
        <tr>
            <td>محرر الفاتورة :</td>
            <td> {{ @$order->user->name }}</td>
        </tr>
        <tr>
            <td colspan="2"> في حالة ارجاع الصنف احضر معك الفاتورة</td>
        </tr>
        <tr>
            <td colspan="2"> فترة الارجاع هي سبعة أيام من تاريخ الفاتورة وشكراً</td>
        </tr>
    </table>
</div>
@endsection