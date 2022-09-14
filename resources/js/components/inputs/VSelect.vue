<script setup>
import { ref } from 'vue';
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
});

defineEmits(['update:modelValue']);

const input = ref(null);

</script>

    <template>
    <div class="mb-3 row">
        <label :for="name" class="col-sm-3  col-form-label">{{ title }}</label>
        <div class="col-sm-9 ">
            <select ref="input" class="form-control" autocomplete="off" :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" :class="error && 'is-invalid'">
                <slot />
            </select>
            <div id="validationServer05Feedback" class="invalid-feedback" v-if="error">
                {{ error[0] }}
            </div>
        </div>
    </div>
</template>
