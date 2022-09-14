<template>
    <div id="printMe" style="display:none">
        <div class="invoice-box rtl">
            <table cellpadding="0" cellspacing="0" class="table">
                <tr class="top">
                    <td colspan="5">
                        <h5 style="text-align: center ;">مغلق الباشمهندس المتكامل</h5>
                        <p style="text-align: center ; "> رقم الهاتف : 0920778096</p>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="5">
                        <table style="font-size: 10px; width: 100%">
                            <tr>
                                <td>
                                    العميل: ......<br />
                                    من : ...<br />
                                </td>

                                <td style="text-align: left">
                                    Number #: {{orders.id}}<br />
                                    Date: {{orders.created_at}}<br />
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
                <tr v-for="i in orders.hasProducts" :key="i" style="text-align: center; font-size: 9px; width: 100%">
                    <td class="num num-15">{{i.order}}</td>
                    <td class="num num-15">{{i.num}} </td>
                    <td class="num number-15">{{i.name}}</td>
                    <td class="num num-15">{{i.price}}</td>
                    <td class="num num-15">{{i.amount}}</td>

                </tr>

                <tr style="text-align: center; font-size: 10px; width: 100%">
                    <td class="num number" colspan="3">جملة المبلغ : </td>
                    <td class="num totel" colspan="2">{{orders.amount}}</td>
                </tr>
            </table>
            <table style="font-size: 10px">
                <tr>
                    <td>محرر الفاتورة :</td>
                    <td> {{orders.admin}}</td>
                </tr>
                <tr>
                    <td colspan="2"> في حالة ارجاع الصنف احضر معك الفاتورة</td>
                </tr>
                <tr>
                    <td colspan="2"> فترة الارجاع هي سبعة أيام من تاريخ الفاتورة وشكراً</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script setup>
    defineProps(['orders'])

</script>
