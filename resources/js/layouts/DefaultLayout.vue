<template>
    <!-- <theme-setting /> -->
    <div id="wrapper">

        <Nav />
        <Sidebar />

        <router-view />
    </div>

</template>
<script setup>
import Nav from '../components/core/Nav.vue';
import Sidebar from '../components/core/Sidebar.vue';
import ThemeSetting from '../components/core/ThemeSetting.vue';

</script>

<style>
</style>
