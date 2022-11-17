<template>
    <v-list class="px-1">
        <MenuItem v-for="(item, index) in sidebar.items" :key="index" :data="item.children" :label="item.text"
            :icon="item.icon" :depth="0" :url="item.url??''" :openUrl="item.url??''" :access="item.access"/>
    </v-list>
</template>

<script>
import { useSettingsItem } from '../../stores/settings/SettingItem';
import MenuItem from './MenuItem.vue';

export default {
    name: 'recursive-menu',
    components: {
        MenuItem
    },
    setup() {
        const sidebar = useSettingsItem();
        return { sidebar }
    }
}
</script>

<style lang="scss" scoped>

</style>
