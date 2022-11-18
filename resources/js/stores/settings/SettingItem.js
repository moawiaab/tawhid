import { defineStore } from "pinia";
import items from "../../plugins/sidebar_item";
import itemsUser from "../../plugins/user_item";
import { useLocalStorage } from "@vueuse/core";
import ability from "@/services/ability";

export const useSettingsItem = defineStore("item-settings", {
    state: () => ({
        items: items,
        userList: itemsUser,
        navSide: useLocalStorage("nav-side", [
            {
                text: "لوحة التحكم",
                icon: "mdi-home-outline",
                url: "/dashboard",
            },
        ]),
        localItems: [],
    }),
    getters: {
        sidebar: (state) => state.items,
        itemNav: (state) => state.navSide,

        itemSide: (state) =>
            state.localItems.filter((e) => {
                let list = state.navSide.map((e) => e.url);
                return !list.includes(e.url);
            }),
    },

    actions: {
        addItem(item) {
            this.navSide.push(item);
        },
        removeItem(index) {
            this.navSide.splice(index, 1);
        },

        setLocalItems() {
            this.localItems = [];
            this.items.filter((e) => {
                if (e.children) {
                    e.children.filter((i) => {
                        this.localItems.push(i);
                    });
                } else {
                    this.localItems.push(e);
                }
            });
        },
        getRoles() {
            axios.get("abilities").then((response) => {
                ability.update([
                    { action: response.data.data, subject: "all" },
                ]);
            });
        },
    },
});
