<script setup>
import { onMounted, ref, computed } from "vue";
import { Modal } from "bootstrap";
const props = defineProps({
    title: {
        type: String,
        default: "<<Title goes here>>",
    },
    backdrop: { type: String, default: "static" },
    maxWidth: { type: String, default: "md" },
    customClass: { type: String, default: "" },
});
let modalEle = ref(null);
let thisModalObj = null;

onMounted(() => {
    thisModalObj = new Modal(modalEle.value);
});
function _show() {
    thisModalObj.show();
}
function _hide() {
    thisModalObj.hide();
}
defineExpose({ show: _show, hide: _hide });
const maxWidthClass = computed(() => {
    return {
        'sm': 'modal-sm',
        'md': 'fade modal-md',
        'lg': 'fade modal-lg',
        'xl': 'fade modal-xl',
        'fxl': 'modal-fullscreen',
    }[props.maxWidth];
});
</script>

    <template>
    <div class="modal fade" :class="maxWidthClass" id="showUserModal" tabindex="-1" aria-labelledby=""
        aria-hidden="true" ref="modalEle" :data-bs-backdrop="backdrop" data-bs-keyboard="true">
        <div class="modal-dialog">
            <div class="modal-content" :class="customClass">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"
                        style="position: absolute; left: 15px;"></button>
                </div>
                <div class="modal-body" >
                    <slot name="body" />
                </div>
                <div class="modal-footer">
                    <slot name="footer"></slot>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        إلغاء
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
