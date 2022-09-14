<template>
    <span v-if="row.deleted_at">
        <span @click.prevent="undoData(row.id)">
            <i class="ri-arrow-go-back-line"></i>
        </span>
    </span>
    <span v-else>
        <span @click.prevent="this.$store
        .dispatch(xprops.module + '/addNewChile', row.id)" class="p-1 cursor-pointer text-secondary"
        v-if="xprops.child && row.status == 1 && row.child == 1">
            <i class="fa fa-plus-circle" />
        </span>
        <span @click.prevent="this.$store
        .dispatch(xprops.module + '/showTake', row)" class="p-1 cursor-pointer text-secondary"
        v-if="xprops.take && row.child">
            <i class="fa  fa-reply" />
        </span>

        <span @click.prevent="doneData(row.id)" class="p-1 cursor-pointer text-success"
        v-if="xprops.done && row.done == 1">
            <i class="fa fa-check" />
        </span>
        <span class="p-1 cursor-pointer text-primary" v-if="$can(xprops.permission_prefix + 'edit') && xprops.editable"
            @click.prevent="this.$store
            .dispatch(xprops.module + '/editData', row.id)">
            <i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="تعديل البيانات"></i>
        </span>

        <span class="p-1 cursor-pointer secondary text-info"
            v-if="$can(xprops.permission_prefix + 'access') && xprops.viewable" @click.prevent="this.$store
            .dispatch(xprops.module + '/fetchShowData', row.id)">
            <i class="fa fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="عرض البيانات"></i>
        </span>
        <span class="p-1 cursor-pointer secondary text-danger"
            v-if="$can(xprops.permission_prefix + 'delete') && xprops.deletable" @click.prevent="destroyData(row.id)">
            <i class="fa fa-archive" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف"></i>
        </span>

        <span class="p-1 cursor-pointer secondary text-success"
            v-if="$can(xprops.permission_prefix + 'edit') && row.toggle == 1"
            @click.prevent="toggleData(row.id)">
            <i class="fa  fa-unlock" data-bs-toggle="tooltip" data-bs-placement="top" title="تغير الحالة"></i>
        </span>

        <span class="p-1 cursor-pointer secondary text-dark"
            v-if="$can(xprops.permission_prefix + 'edit') && row.toggle == 0"
            @click.prevent="toggleData(row.id)">
            <i class="fa fa-lock" data-bs-toggle="tooltip" data-bs-placement="top" title="تغير الحالة" />
        </span>

    </span>
</template>

<script >
import { useToast } from "vue-toastification";
const toast = useToast();
export default {
    props: ['row', 'xprops'],
    methods: {
        destroyData(id) {
            this.$swal.fire({
                title: 'هل تريد الحذف بالفعل',
                icon: 'error',
                position: 'center',
                showCancelButton: true,
                cancelButtonText: ` إلغاء الأمر`,
                confirmButtonText: `تأكيد الحذف`,
                confirmButtonColor: '#dd4b39',
                showConfirmButton: true,
                toast: false
            }).then(result => {
                if (result.value) {
                    this.$store
                        .dispatch(this.xprops.module + '/destroyData', id)
                        .then(result => {
                            // toast.success("تم الحذف بنجاح ستجده في سلة المهملات");
                        })
                }
            })
        },
        undoData(id) {
            this.$swal.fire({
                confirmButtonText: `تأكيد الارجاع`,
                title: 'هل تريد الحذف بالفعل',
                icon: 'question',
                position: 'center',
                showCancelButton: true,
                confirmButtonColor: 'rgb(21, 99, 221)',
                cancelButtonText: ` إلغاء الأمر`,
                showConfirmButton: true,
            }).then(result => {
                if (result.value) {
                    this.$store
                        .dispatch(this.xprops.module + '/undoData', id)
                        .then(result => {
                            toast.success("تم الارجاع بنجاح ");
                        })
                }
            })
        },
        toggleData(id) {
            this.$swal.fire({
                confirmButtonText: ` تغيرالحالة`,
                cancelButtonText: ` إلغاء الأمر`,
                title: 'هل تريد تغيير الحالة بالفعل',
                text: 'يتم تغير الحالة من الفتح الى الإغلاق والعكس',
                icon: 'question',
                position: 'center',
                showCancelButton: true,
                confirmButtonColor: 'rgb(21, 99, 221)',
                showConfirmButton: true,
                toast: false
            }).then(result => {
                if (result.value) {
                    this.$store
                        .dispatch(this.xprops.module + '/toggleData', id)
                        .then(result => {
                            toast.success("تم تغيير الحالة بنجاح");
                        })
                }
            })
        },
        doneData(id) {
            this.$swal.fire({
                confirmButtonText: ` استلام`,
                cancelButtonText: ` إلغاء الأمر`,
                title: this.xprops.title,
                text: this.xprops.text,
                icon: 'question',
                position: 'center',
                showCancelButton: true,
                confirmButtonColor: 'rgb(21, 99, 221)',
                showConfirmButton: true,
                toast: false
            }).then(result => {
                if (result.value) {
                    this.$store
                        .dispatch(this.xprops.module + '/doneData', id)
                        .then(result => {
                            toast.success("تم  العملية بنجاح");
                        })
                }
            })
        },
    }
}
</script>

<style scoped>
span {
    cursor: pointer;
    text-align: center;
    align-items: center;
}
</style>

