<script setup>
import LabelText from "./Label.vue";
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid'

defineProps({
    modelValue: String,
    title: String,
    name: {
        type: String,
        default() {
            return `n-${uuid()}`
        },
    },

    error: String,
    required: {
        type: Boolean,
        default: false
    },
    col: { type: String, default: 'col-md-6' }
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
    <div class="form-group mb-3" :class="col">
        <label :for="name" class="form-label">{{ title }}</label>
        <textarea ref="input" class="form-control" autocomplete="off" :value="modelValue" :id="name" :name="name"
            @input="$emit('update:modelValue', $event.target.value)" :class="error && 'is-invalid'"
            :required="required"></textarea>
        <div id="validationServer05Feedback" class="invalid-feedback" v-if="error">
            {{ error[0] }}
        </div>
    </div>
</template>
