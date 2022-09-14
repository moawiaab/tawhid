<template>
    <div v-if="row[`${field}`] == 1" class="badge bg-success">
        جديد
    </div>
    <div class="badge bg-light text-info" v-else>
        مكتمل
    </div>
</template>

<script setup>
defineProps(['field', 'row'])
</script>
