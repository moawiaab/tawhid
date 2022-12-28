<template>
    <v-card class="mx-auto mt-16" max-width="800">
        <v-row align="center">
            <v-col class="mx-auto">
                <v-img :src="`/assets/images/login.png`" class="align-end">
                </v-img>
            </v-col>
            <v-divider vertical inset></v-divider>
            <v-col>
                <v-container>
                    <v-snackbar
                        v-model="alertData.snackbar"
                        absolute
                        text
                        :color="alertData.color"
                        close-on-content-click
                        location="top"
                    >
                        {{ alertData.alert }}
                    </v-snackbar>
                    <router-view />
                </v-container>
            </v-col>
        </v-row>
    </v-card>
</template>
<script>
import { useSettingAlert } from "../stores/settings/SettingAlert";
export default {
    setup() {
        const alertData = useSettingAlert();

        return {
            alertData,
        };
    },
};
</script>
