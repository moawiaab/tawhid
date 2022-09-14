<template>
    <div>
        <span v-if="row[entry.key]" style="">
            <div class="row">
                <span v-for="i in row[entry.key]" :key="i.id" class="badge  mb-2 w150"
                    :class="color ? `badge-${color}` : ' badge-primary'">
                    {{ i.details }}
                </span>
            </div>
        </span>
        <span v-else class="badge  badge-danger">
            Not Assigned
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
