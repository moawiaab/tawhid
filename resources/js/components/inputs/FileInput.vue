<template>


    <div class="custom-file" @dragenter.prevent="" @dragover.prevent="" @drop.prevent="handleFiles">
        <input type="file" class="custom-file-input" ref="file" :accept="accept" @change="change">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>

</template>

<script>
export default {
    props: {
        modelValue: File,
        label: String,
        accept: String,
        errors: {
            type: Array,
            default: () => [],
        },
    },
    emits: ['update:modelValue'],
    watch: {
        modelValue(value) {
            if (!value) {
                this.$refs.file.value = ''
            }
        },
    },
    methods: {
        filesize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024))
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
        },
        browse() {
            this.$refs.file.click()
        },
        change(e) {
            this.$emit('update:modelValue', e.target.files[0])
        },
        remove() {
            this.$emit('update:modelValue', null)
        },

        handleFiles(e) {
            const inputValue = e.target.files || e.dataTransfer.files || this.$refs.file.files
            for (let i = 0; i < inputValue.length; i++) {
                const file = inputValue[i]
                this.files.push(file.name)
            }
        }
    },
}
</script>
<style scoped>

</style>
