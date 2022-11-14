
<template>
    <v-app id="" :theme="settings.getTheme">
        <v-layout ref="app" dir="rtl" v-resize="settings.onResize">
            <v-system-bar>
                <v-btn variant="text" :prepend-icon="!settings.menu ? 'mdi-menu-open' : 'mdi-menu-right-outline'"
                    @click="settings.setMenu" width="20" class="px-1">
                </v-btn>

                <v-btn variant="text"
                    :prepend-icon="settings.getTheme == 'light' ? 'mdi-weather-sunny' : 'mdi-weather-night'"
                    @click="settings.setTheme" width="20" class="px-1">
                </v-btn>

                <v-btn variant="text" :prepend-icon="wifi" />
                <v-icon>wifi</v-icon>

                <v-icon>mdi-triangle</v-icon>
                <v-spacer></v-spacer>
                <v-btn variant="text" prepend-icon="mdi-clock-outline"> {{ formatDate(now, "hh:mm:ss") }} </v-btn>
                <v-btn variant="text" prepend-icon="mdi-calendar-range"> {{ formatDate(now, "YYYY-MM-DD") }} </v-btn>

            </v-system-bar>
            <v-navigation-drawer v-model="settings.menu" class="pt-5" rail location="end" v-if="settings.window > 1280">
                <Dialog />
                <router-link v-for="item, n in sidebar.itemNav" :key="n" :to="item.url ?? ''">
                    <v-avatar :color="`grey-${router.path === item.url ? 'darken' : 'lighten'}-2`" size="36"
                        class="d-block text-center mx-auto mb-5" :icon="item.icon" />
                    <v-tooltip activator="parent" location="start">{{ item.text }}</v-tooltip>
                </router-link>
            </v-navigation-drawer>
            <v-navigation-drawer v-model="settings.drawer" location="end">
                <!--  -->
                <v-row align="end" dir="ltr" v-if="settings.window < 1280">
                    <v-app-bar-nav-icon @click="settings.drawer = false" v-cloak>
                        <v-icon icon="mdi-close" />
                    </v-app-bar-nav-icon>
                </v-row>

                <v-list color="main-side">
                    <v-list-subheader title="القائمةالجانبية"></v-list-subheader>
                    <!-- <router-link v-for="(item, i) in sidebar.items" :key="i" :to="item.url">
                        <v-list-item :value="item" :class="router.path === item.url && 'active-item-aside'" class="mx-1"
                            variant="plain" :prepend-icon="item.icon">
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item>
                    </router-link> -->

                    <recursive-menu />
                </v-list>
            </v-navigation-drawer>
            <v-app-bar elevation="1" height="50">
                <v-app-bar-nav-icon @click="settings.setDrawer">
                    <v-icon icon="mdi-menu" />
                </v-app-bar-nav-icon>
                <!-- <v-toolbar-title>اسم البرنامج <v-icon icon="mdi-keyboard-backspace"></v-icon> {{ router.name }}
                </v-toolbar-title> -->
                <v-toolbar-title />
                <v-menu transition="scroll-x-transition">
                    <template v-slot:activator="{ props }">
                        <v-list-item title="welcome" prepend-icon="mdi-account-circle" v-bind="props" value="22">
                        </v-list-item>
                        <!-- <v-avatar size="36" class="text-center mx-5" icon="mdi-account-circle" v-bind="props" >
                        </v-avatar> -->
                    </template>
                    <v-list>
                        <v-list-item v-for="(item, index) in sidebar.userList" :key="index" :value="index"
                            variant="plain" class="text-right" @click="password.userMenuClicked(item)">

                            <template v-slot:prepend>
                                <v-icon :icon="item.icon"></v-icon>
                            </template>

                            <v-list-item-title v-text="item.text"></v-list-item-title>

                        </v-list-item>

                        <v-list-item variant="plain" class="text-right" value="565" @click.prevent="settings.logout">
                            <template v-slot:prepend>
                                <v-icon icon="mdi-login-variant" />
                            </template>
                            <v-list-item-title v-text="'تسجيل خروج'" />
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-app-bar>

            <v-main class="" scrollable>
                <Password />
                <v-container fluid>
                    <v-snackbar v-model="alertData.snackbar" absolute text :color="alertData.color"
                        close-on-content-click location="top">
                        {{ alertData.alert }}
                    </v-snackbar>
                    <router-view />
                </v-container>
            </v-main>
        </v-layout>
    </v-app>
</template>

<script>
import { computed, ref, watch } from 'vue'
import { useOnline, formatDate, useNow, useTitle } from '@vueuse/core'
import { useRoute, useRouter } from "vue-router";
import { useSetting } from '../stores/settings/SettingIndex'
import { useSettingsItem } from '../stores/settings/SettingItem';
import { useSettingPassword } from '../stores/settings/SettingPassword';
import { useSettingAlert } from '../stores/settings/SettingAlert';
import Dialog from '../components/Dialog.vue';
import Password from '../components/dialog/Password.vue';
import RecursiveMenu from '../components/menu/Menu.vue';
export default {
    components: { Dialog, Password, RecursiveMenu },
    setup() {
        const open = ref(false)
        const settings = useSetting();
        const sidebar = useSettingsItem();
        const password = useSettingPassword()
        const now = useNow();
        const router = useRoute();
        const routerList = useRouter();
        const online = useOnline()
        const alertData = useSettingAlert()
        const wifi = computed(() => online.value ? 'mdi-wifi-arrow-left-right' : 'mdi-wifi-strength-off-outline')
        useTitle(`اسم البرنامج | ${router.name}`)
        watch(router, (e) => {
            useTitle(`اسم البرنامج | ${e.name}`);
            sidebar.getRoles()
        })

        const items = [
            { title: 'Click Me' },
            { title: 'Click Me' },
            { title: 'Click Me' },
            { title: 'Click Me 2' },
        ];
        return {
            open,
            items,
            settings,
            wifi,
            now,
            formatDate,
            router,
            sidebar,
            password,
            alertData,
            routerList
        }
    }
}
</script>

<style scoped>
.notranslate.v-icon {
    margin-left: 7px !important;
}

.v-list-item__prepend>.v-icon {
    margin-inline-end: 10px !important;
    margin-left: 10px !important;
}

.active-item-aside {
    background-color: #dfd4e9;
    border-radius: 5px !important;
}
</style>
