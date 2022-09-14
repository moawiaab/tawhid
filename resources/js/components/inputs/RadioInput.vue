<script setup>
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid'
defineProps({
    modelValue: String,
    title: String,
    id: {
        type: String,
        default() {
            return `n-${uuid()}`
        },
    },
    value: String,

});

defineEmits(['update:modelValue']);

const input = ref(null);

</script>

    <template>
    <div class="fancy-radio">
        <label>
            <input :id="id" :value="modelValue" type="radio" @input="$emit('update:modelValue', $event.target.value)"
                class="">
            <span><i></i>{{ title }}</span>
        </label>
    </div>
</template>
