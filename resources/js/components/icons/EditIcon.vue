<template>
    <v-icon icon="mdi-pencil-outline" color="green" class="mx-1" v-if="$can(`${role}_edit`)" />
</template>

<script>
export default {
    name: "EditIcon",
    props: ['role']
}
</script>
