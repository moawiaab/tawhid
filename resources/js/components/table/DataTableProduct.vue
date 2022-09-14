<template>
    <div v-if="row[`${field}`]">
        <p v-for="i in row[`${field}`]" :key="i.id">
            <span class="badge" :class="i.status == 1 ? 'badge-default' : 'badge-success'">الصنف : {{i.name}}
                <span class="badge" :class="i.status == 1 ? 'bg-dark' : 'bg-success'"> العدد : {{i.num}}</span>
                <span class="badge badge-danger" v-if="i.back"> راجع :{{i.back}}</span>
            </span>
        </p>
    </div>
</template>

<script>
export default {
    props: ['field', 'row', 'color'],
}
</script>

<style scoped>
.badge {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: none;
}
.badge-success{
    background-color: #0ce69d1f
}
.badge-info{
    background-color: #60d7fb33
}
p {
    padding: 0px;
    margin-bottom: 2px;
}

.bg-dark {
    border-radius: 10px;
}
</style>
