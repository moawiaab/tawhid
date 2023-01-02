import axios from "axios";
import { defineStore } from "pinia";
import { useLocalStorage } from "@vueuse/core";

export const useSetting = defineStore("index-Setting", {
    state: () => ({
        theme: useLocalStorage("theme", "light"),
        drawer: useLocalStorage("drawer", false),
        menu: useLocalStorage("menu", false),
        showClose: false,
        window: window.innerWidth,
    }),
    getters: {
        getTheme: (state) => state.theme,
        getDrawer: (state) => state.drawer,
    },

    actions: {
        setTheme() {
            this.theme = this.theme === "light" ? "dark" : "light";
        },

        setDrawer() {
            this.drawer = this.drawer ? false : true;
        },

        setMenu() {
            this.menu = this.menu ? false : true;
        },

        onResize() {
            this.showClose =
                window.innerWidth < 1280 && this.drawer ? true : false;
        },

        logout() {
            axios
                .request({ baseURL: "/", url: "logout", method: "post" })
                .then(() => location.assign("/"));
        },


    },
});
