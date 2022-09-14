<template>
    <div>
        <span v-if="row[entry.key]" class="badge" :class="color ? `badge-${color}` : ' badge-primary'">
            {{ row[entry.key][entry.field] ?? row[entry.key]}}
        </span>
        <span v-else>
            <span v-if="row[`${field}`]" class="badge" :class="color ? `badge-${color}` : ' badge-primary'">
                {{  row[`${field}`] ?? '-'}}
            </span>
            <span v-else class="badge  badge-danger">
                لا يوجد
            </span>
        </span>
    </div>
</template>

<script>
export default {
    props: ['field', 'row', 'color'],
    computed: {
        entry() {
            let s = _.split(this.field, '.')
            return {
                key: s[0],
                field: s[1]
            }
        }
    }
}
</script>

<style scoped>
.badge {
    font-size: 0.875rem;
    font-weight: 400;
    text-transform: none;
}
</style>
