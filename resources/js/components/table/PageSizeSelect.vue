<template>
    <label name="PageSizeSelect">
        <span class="refresh btn btn-just-icon btn-link" @click.prevent="this.$store
        .dispatch(xprops.module + '/fetchIndexData')" v-if="xprops.module"> تحديث :
            <i class="fa fa-refresh"> </i>
        </span>
        <span> عدد :</span>
        <select class="form-control input-sm -page-size-select" v-model="query.limit"
            @change="query.offset = 0 /* reset to the first page */">
            <option v-for="i in pageSizeOptions" :value="i" :key="i">{{ i }}</option>
        </select>
    </label>
</template>
<script>
export default {
    name: 'PageSizeSelect',
    props: {
        query: { type: Object, required: true },
        pageSizeOptions: { type: Array, required: true },
        xprops : Object
    }
}
</script>
<style scoped>
.refresh {
    cursor: pointer;
}

.-page-size-select {
    display: inline-block;
    width: 65px;
}
</style>
