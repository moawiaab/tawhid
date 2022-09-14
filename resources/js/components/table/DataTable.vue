<template>
    <div class="table-responsive">
        <div class="d-flex justify-content-between align-items-center w-full" v-if="query">
            <SearchFilter :query="query" />
            <div class="form-group">
                <page-size-select :query="query" :page-size-options="pageSizeOptions" :xprops="xprops" />
            </div>

        </div>
        <table class="table table-hover table-custom spacing5" :class="customClass">
            <thead>
                <tr>
                    <th v-for="(col, id) in columns" :key="id" :style="col.colStyle" class="w60"
                        :class="col.type === 'listCol' && 'w350 align-top'">
                        {{ col.title }}
                        <span class="store">
                            <span v-if="col.slot">
                                <i @click="slots(col.field, 'desc')" class="fa fa-sort-desc"
                                    v-if="col.field == query.sort && query.order == 'asc'"></i>
                                <i @click="slots(col.field, 'asc')" class="fa fa-sort-asc"
                                    v-else-if="col.field == query.sort && query.order == 'desc'"></i>
                                <span v-else>
                                    <i @click="slots(col.field, 'desc')" class="fa fa-sort-desc"></i>
                                    <i @click="slots(col.field, 'asc')" class="fa fa-sort-asc"></i>
                                </span>
                            </span>
                            <!-- <span><i class="fa-sort-desc"></i></span> -->
                        </span>
                    </th>
                    <th v-if="action" class="w-100" style="width:100px !important">

                    </th>
                </tr>
            </thead>
            <tbody v-if="data">
                <tr v-for="item in data" :key="item.id" :class="{ 'text-success' : item.done }">
                    <td v-for="col in columns" :key="col.field" :color="item.deleted_at && 'table-danger'"
                        @dblclick.passive="goTo(item.id)">
                        <DatatableSingle v-if="col.type === 'item'" :row="item" :field="col.field" :color="col.color" />
                        <DatatableEnum v-else-if="col.type === 'enum'" :row="item" :field="col.field" />
                        <DatatableCheck v-else-if="col.type === 'check'" :row="item" :field="col.field" />
                        <DataTableProduct v-else-if="col.type === 'product'" :row="item" :field="col.field" />
                        <DataTableListCol v-else-if="col.type === 'listCol'" :row="item" :field="col.field"
                            :color="col.color" />
                        <template v-else>
                            <span v-if="item[col.field] !== undefined">
                                <span v-if="item[col.field] !== null && item[col.field].length > 20"
                                    data-bs-toggle="tooltip" data-bs-placement="top" :title="item[col.field]">{{
                                    item[col.field].slice(0,
                                    20) + '..'
                                    }}</span>
                                <span v-else>{{ item[col.field] }}
                                    <span v-if="col.sup">
                                        {{col.sup}}
                                    </span>
                                    <span v-if="col.back && item.back > 0 " class="badge badge-danger">
                                        راجع : {{item.back}}
                                    </span>
                                </span>
                            </span>
                            <span v-else> - </span>
                        </template>
                    </td>
                    <td v-if="action" style="width:100px !important; text-align:left; ">
                        <ActionTable :row="item" :xprops="xprops" />
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center w-full mx-5 mb-4" v-if="query">
        <span>عرض : {{ query.limit }} من جملة : {{ total }}</span>
        <Pagination class="pull-left" :total="total" :query="query" />
        <!-- <page-size-select :query="query" :page-size-options="pageSizeOptions" /> -->
    </div>
</template>

<script setup>
import DatatableSingle from './DatatableSingle.vue';
import Pagination from './Pagination.vue';
import PageSizeSelect from './PageSizeSelect.vue';
import SearchFilter from './SearchFilter.vue';
import ActionTable from './ActionTable.vue';
import DataTableListCol from './DataTableListCol.vue';
import DatatableEnum from './DatatableEnum.vue';
import { useStore } from 'vuex';
import { useToast } from "vue-toastification";
import DatatableCheck from "./DatatableCheck.vue";
import DataTableProduct from './DataTableProduct.vue';
const toast = useToast();
const store = useStore();

const props = defineProps(
    {
        data: Array,
        columns: Object,
        action: {
            type: Boolean,
            default: true
        },
        rowClick: {
            type: Boolean,
            default: false
        },
        xprops: {
            type: Object,
            default: () => ({})
        },
        query: Object,
        total: Number,
        pageSizeOptions: {
            type: Array,
            default: [5, 10, 15, 25, 50, 100, 200]
        },
        action: { type: Boolean, default: true },
        customClass: { type: String, default: "" },
        onclick: { type: Boolean, default: true },
        done: { type: Boolean, default: true }
    }
)

const slots = async (slot, order) => {
    if (props.query) {
        props.query.order = order
        props.query.sort = slot
    } else {
        toast.info('هذا الجدول لا يحتوي على عملية البحث و الفلترة')
    }
    // console.log(props.query)
}

const goTo = (id) => {
    if (props.onclick) {
        store.dispatch(props.xprops.module + '/fetchShowData', id)
    } else {
        toast.warning('لا يوجد مزيد من البيانات لعرضها')
    }
}

</script>

<style scoped>
.table tr td {
    vertical-align: top !important;
}

span.store {
    position: relative;
}

span.store i {
    position: absolute;
    font-size: 18px;
    right: 10px;
    padding: 0;
    margin: 0;
}

.fa-sort-asc {
    bottom: 1px;
    cursor: pointer;
}

.fa-sort-desc {
    top: 1px;
    cursor: pointer;
}

.fa-sort-asc:hover,
.fa-sort-desc:hover {
    color: green;
}

select,
select:focus {
    outline: none !important;
    box-shadow: none;
    border-radius: 0;
}
</style>

