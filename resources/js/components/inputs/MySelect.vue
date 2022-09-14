<template>
    <!-- <div class="fixed inset-0" @click="isVisible = false" /> -->
    <section v-click-outside="handleClick" class="dropdown-wrapper">

        <div @click="isVisible = true" class="select-item bg-white">
            <input class="border-none form-control" type="text" v-model="mySearchQueryLocal"
                :placeholder="selectedItem ? selectedItem.name ?? selectedItem.label : ''">
            <span v-if="selectedItem" @click="removeText"
                class="absolute left-7 text-justify-content close cursor-pointer top-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" />
                </svg>
            </span>
            <svg :class="isVisible && 'active'" class="drop-down-icon text-gray-600" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" width="24" height="24">
                <path fill="none" d="M0 0h24v24H0z" />
                <path d="M12 16l-6-6h12z" fill="rgba(77,75,75,1)" />
            </svg>
        </div>

        <div :class="isVisible && 'visible'" v-if="isVisible" class="dropdown-popover z-50 transition">


            <li v-if="filterData.length === 0" class="p-2 bg-red-600 w-full list-none text-white">لا يوجد منتج بهذا
                الاسم</li>
            <div class="options">
                <ul>
                    <li @click="selectItem(item), $emit('haveData', item)" v-for="item in filterData" :key="item.id">{{
                    item.name ?? item.label
                    }}</li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed, ref } from 'vue'
const mySearchQueryLocal = ref('')
const selectedItem = ref(null)
const isVisible = ref(false)

const props = defineProps({
    options: Object,
    modelValue: String,
})

defineEmits(['haveData'])

const filterData = computed(() => {
    const query = mySearchQueryLocal.value.toLowerCase();
    if (mySearchQueryLocal.value === "") {
        return props.options
    }
    return props.options.filter((data) => {
        return data.label.toLowerCase().includes(query)
    });
})
const handleClick = () => isVisible.value = false
const selectItem = (item) => {
    selectedItem.value = item
    mySearchQueryLocal.value = ""
    isVisible.value = false
}
const removeText = () => {
    selectedItem.value = null
    isVisible.value = false
}

const VClickOutside = {
    mounted(el, binding) {
        el.__ClickOutsideHandler__ = (event) => {
            if ((!(el === event.target || el.contains(event.target))) && isVisible.value) {
                binding.value(event)
            }
        }
        document.body.addEventListener('click', el.__ClickOutsideHandler__)
    },
    unmounted(el) {
        document.body.removeEventListener('click', el.__ClickOutsideHandler__)
    },
}
</script>
<style scoped lang="scss">
.dropdown-wrapper {
    position: relative;
    margin: 0;
    z-index: 100;

    .select-item {
        height: 44px;
        border: 2px solid lightgray;
        border-radius: 5px;
        padding: 5px 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;

        input {
            width: 100%;
            height: 40px;
            border: none;
        }

        .drop-down-icon {
            transform: rotate(0deg);
            transition: 0.3s all ease-in-out;

            &.active {
                transform: rotate(180deg);
                transition: 0.3s all ease-in-out;
            }
        }
    }

    .dropdown-popover {
        position: absolute;
        border: 2px solid lightgray;
        top: 46px;
        left: 0;
        right: 0;
        background-color: #fff;
        max-width: 100%;
        visibility: hidden;
        max-height: 0px;

        &.visible {
            top: 40px;
            max-height: 450px;
            visibility: visible;
            transition: 0.4s ease-in-out;
        }

        .options {
            width: 100%;

            ul {
                list-style: none;
                text-align: right;
                max-height: 200px;
                overflow-y: scroll;
                overflow-x: hidden;
                padding: 0 !important;

                li {
                    width: 100%;
                    border-bottom: 1px solid lightgrey;
                    padding: 10px;
                    background-color: #f1f1f1;
                    cursor: pointer;

                    &:hover {
                        background-color: rgb(51, 54, 51);
                        color: #fff;
                    }
                }
            }
        }
    }
}
</style>
