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
    type: {
        type: String,
        default: 'text'
    },
    error: String,
    required: {
        type: Boolean,
        default: true
    }
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
    <div class="mb-3 row">
        <label :for="name" class="col-sm-3  col-form-label">{{ title }}</label>
        <div class="col-sm-9 ">
            <input ref="input" class="form-control" autocomplete="off" :type="type" :value="modelValue" :id="name"
                :name="name" @input="$emit('update:modelValue', $event.target.value)" :class="error && 'is-invalid'"
                :required="required" step="0.01">
            <div id="validationServer05Feedback" class="invalid-feedback" v-if="error">
                {{ error[0] }}
            </div>
        </div>
    </div>
</template>
