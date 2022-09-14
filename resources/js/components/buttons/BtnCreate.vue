<template>
    <button :type="type" :class="`btn ${color}  mb-2`" :disabled="disabled">
        <span v-if="disabled">
            <i class="fa fa-spinner fa-spin"></i>
            <span class="mx-1"> انتظر من فضلك ... </span>
        </span>
        <span v-else>
            <i :class="`fa ${icon}`"></i>
            <span class="mx-1"> {{ title }} </span>
        </span>

    </button>
</template>

<script setup>
defineProps({
    title: { type: String, default: "إضافة" },
    icon: { type: String, default: "fa-check-circle" },
    type: { type: String, default: "button" },
    color: { type: String, default: "btn-success" },
    disabled: { type: Boolean, default: false },
})
</script>
