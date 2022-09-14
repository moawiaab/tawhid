<template>
    <router-view />
</template>

<script>
import { Tooltip } from "bootstrap";

new Tooltip(document.body, {
    selector: "[data-bs-toggle='tooltip']",
});
export default {

}
</script>

