<template>

</template>

<script>
import { ref, computed } from "vue";
import { useSingleRoles } from '../../stores/roles/single';

export default {
    name: "CreateRole",
    setup() {
        let thisModal = ref(null);
        const single = useSingleRoles();
        const showModal = () => {
            single.$reset();
            single.fetchCreateData()
            thisModal.value.show();
        }
        const submitForm = () => single.storeData().then(() => thisModal.value.hide())
        return {
            thisModal,
            single,
            showModal,
            submitForm,
        }
    },

}
</script>
