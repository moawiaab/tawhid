<template>

</template>

<script>
import { ref, computed, watch } from "vue";
import { useSingleRoles } from '../../stores/roles/single';

export default {
    name: "EditRole",
    setup() {
        let thisModal = ref(null);
        const single = useSingleRoles();
        const submitForm = () => single.updateData().then(() => thisModal.value.hide())
        const showModal = computed(() => single.showModalEdit);

        watch(showModal, (q) => {
            thisModal.value.show();
        }, { deep: true });
        return {
            thisModal,
            single,
            submitForm,
        }
    },
}
</script>
