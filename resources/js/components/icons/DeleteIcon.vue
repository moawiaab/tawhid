<template>

    <v-icon :icon="resat ? 'mdi-backup-restore' : 'mdi-trash-can'" :color="resat ? 'green' : 'error'" class="mx-1"
        v-if="$can(`${role}_delete`)" />

</template>

<script>
export default {
    name: "DeleteIcon",
    props: {
        resat: { type: Boolean, default: false },
        role: { type: String, default: 'none' }
    }
}
</script>
