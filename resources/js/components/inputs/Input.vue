<script setup>
import LabelText from "./Label.vue";
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid'

defineProps({
    modelValue: String,
    title: String,
    type: {
        type: String,
        default: 'text'
    },
    required: {
        type: Boolean,
        default: true
    },
    name: {
        type: String,
        default() {
            return `n-${uuid()}`
        },
    },
    error: String,
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
        <input ref="input" class="form-control" autocomplete="off" :value="modelValue" :type="type"
            @input="$emit('update:modelValue', $event.target.value)" :required="required" :id="name" :name="name">
        <div id="validationServer05Feedback" class="invalid-feedback" v-if="error" step="0.01">
            {{ error[0] }}
        </div>
    </div>
</template>
