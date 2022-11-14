<template>
    <v-row justify="center" dir="rtl">
        <v-dialog v-model="dialog" scrollable max-width="800" class="text-right">
            <template v-slot:activator="{ props }">
                <v-avatar variant="plain" class="d-block text-center mx-auto mb-5" icon="mdi-playlist-edit"
                    v-bind="props" />
            </template>
            <v-card>
                <v-card-title>إعدادات اختصارات التنقل</v-card-title>
                <v-divider></v-divider>
                <v-card-text style="height: 300px;">
                    <v-row no-gutters class="">
                        <v-col cols="5">
                            <v-list-item title="الإختصارات" />
                            <v-sheet class="px-2">
                                <v-list>
                                    <v-list-item v-for="(item, index) in items.itemNav" :key="index" :title="item.text"
                                        :value="index" :append-icon="item.icon" variant="plain"
                                        @click="items.removeItem(index)"></v-list-item>
                                </v-list>
                            </v-sheet>
                        </v-col>
                        <v-divider vertical></v-divider>
                        <v-col class="text-center align-center py-16">
                            <v-icon icon="mdi-swap-horizontal" size="50" />
                        </v-col>
                        <v-divider vertical></v-divider>
                        <v-col cols="5" class="mx-1">
                            <v-list-item title="القائمة الجانبية" />
                            <v-sheet class="px-2">
                                <v-list>
                                    <v-list-item v-for="(item, index) in items.itemSide" :key="index" :title="item.text"
                                        :value="index" :append-icon="item.icon" variant="plain"
                                        @click="items.addItem(item)"></v-list-item>
                                </v-list>
                            </v-sheet>
                        </v-col>

                    </v-row>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
                        قفل النافذة
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { useSettingsItem } from '../stores/settings/SettingItem';
import { ref } from 'vue';
export default {

    setup() {
        const items = useSettingsItem();
        items.setLocalItems()
        const dialog = ref(false)
        return { items, dialog }
    }
}
</script>
