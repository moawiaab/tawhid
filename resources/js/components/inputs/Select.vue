<script setup>
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid'

defineProps({
    modelValue: String,
    name: {
        type: String,
        default() {
            return `n-${uuid()}`
        },
    },
    title: String,
    error: String,
    col: { type: String, default: 'col-md-6'}
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div :class="col">
        <label :for="name" class="form-label">{{ title }}</label>
        <select ref="input" class="form-control" autocomplete="off" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)" :class="error && 'is-invalid'">
            <slot />
        </select>
        <div id="validationServer05Feedback" class="invalid-feedback" v-if="error">
            {{ error[0] }}
        </div>
    </div>
</template>
