<template>
    <div class="container">
        <div class="dropzone">
            <div v-bind="getRootProps()" class="dropZoneWrap">
                <input v-bind="getInputProps()" class="dropZoneFile" id="dropZoneFile" @change="handleFiles" />
                <label for="dropZoneFile" class="dropZoneLabel">
                    <svg width="10em" height="10em" viewBox="0 0 16 12" class="dropZoneImage" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="m 8.0274054,0.49415269 a 5.53,5.53 0 0 0 -3.594,1.34200001 c -0.766,0.66 -1.321,1.52 -1.464,2.383 -1.676,0.37 -2.94199993,1.83 -2.94199993,3.593 0,2.048 1.70799993,3.6820003 3.78099993,3.6820003 h 8.9059996 c 1.815,0 3.313,-1.43 3.313,-3.2270003 0,-1.636 -1.242,-2.969 -2.834,-3.194 -0.243,-2.58 -2.476,-4.57900001 -5.1659996,-4.57900001 z m 2.3539996,5.14600001 -1.9999996,-2 a 0.5,0.5 0 0 0 -0.708,0 l -2,2 a 0.5006316,0.5006316 0 1 0 0.708,0.708 l 1.146,-1.147 v 3.793 a 0.5,0.5 0 0 0 1,0 v -3.793 l 1.146,1.147 a 0.5006316,0.5006316 0 0 0 0.7079996,-0.708 z" />
                    </svg>
                    <div class="dropZoneBody">
                        <p v-if="isDragActive">Drop the files here ...</p>
                        <p v-else>Drag 'n' drop some files here, or click to select files</p>
                    </div>
                </label>
            </div>
            <!-- <button @click="open">open</button> -->
        </div>
        <slot />
    </div>
</template>

<script setup>
import { useDropzone } from "vue3-dropzone";
import axios from "axios";


const result = useDropzone(onDrop())

function onDrop(acceptFiles, rejectReasons) {
    // saveFiles(acceptFiles); // saveFiles as callback
    console.log(rejectReasons);
}

const saveFiles = (files) => {
    const formData = new FormData(); // pass data as a form
    for (var x = 0; x < files.length; x++) {
        formData.append("images[]", files[x]);
    }
    axios
        .post(url, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then((response) => {
            console.info(response.data);
        })
        .catch((err) => {
            console.error(err);
        });
};


const handleFiles = (e) => {
    const inputValue = e.target.files || e.dataTransfer.files || this.$refs.dropzoneFile.files
    for (let i = 0; i < inputValue.length; i++) {
        const file = inputValue[i]
        this.files.push(file)
    }
    this.$emit('update:modelValue', this.files)
}
</script>
<style scoped>
.dropzone {
    overflow-wrap: break-word !important;
    padding: 0.5rem !important;
    max-width: calc(100vw - 0.5rem) !important;
    max-height: calc(100vh - 0.5rem) !important;
}


input#dropZoneFile {
    position: absolute !important;
    width: 0px !important;
    height: 0px !important;
    overflow: hidden !important;
    clip: rect(1px, 1px, 1px, 1px) !important;
}

.dropzone .dropZoneWrap {
    border: 3px dashed currentColor !important;
    box-shadow: -1px 5px 25px -9px rgba(0, 0, 0, 0.2) !important;
}

.dropzone .dropZoneWrap .dropZoneLabel {
    display: grid !important;
    place-items: center !important;
    width: 100% !important;
    height: 100% !important;
    padding-top: 1.5rem !important;
    padding-bottom: 2.5rem !important;
    cursor: pointer !important;
}

.dropzone .dropZoneWrap .dropZoneImage {
    pointer-events: none !important;
    color: currentColor !important;
}

.dropzone .dropZoneWrap .dropZoneBody {
    text-align: center !important;
}

.dropzone .dropZoneWrap .dropZoneBody p,
.dropzone .dropZoneWrap .dropZoneBody span {
    margin: 0px !important;
}

.dropzone .dropZoneWrap .dropZoneBody .dropZoneTitle {
    color: #333 !important;
}

.dropzone .dropZoneWrap .dropZoneBody .dropZoneText {
    color: #737373 !important;
}

.dropzone .dropZoneWrap .dropZoneBody .button {
    background-color: transparent !important;
    display: inline-block !important;
    text-align: center !important;
    vertical-align: middle !important;
    pointer-events: none !important;
    font-size: 1rem !important;
    line-height: 1.5rem !important;
    font-weight: 400 !important;
    user-select: none !important;
    margin-top: 1.25rem !important;
    border-radius: 0.35rem !important;
    color: currentColor !important;
    border: 2px solid currentColor !important;
    padding: 0.375rem 0.75rem !important;
}

.box1 {
    padding: 10px !important;
    background-color: seagreen !important;
}

.box2 {
    padding: 12px !important;
    background-color: olive !important;
}

p {
    text-align: justify !important;
}

.container {
    max-width: 1024px !important;
    width: 100% !important;
    margin: auto !important;
}
</style>
