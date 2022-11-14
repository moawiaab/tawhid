import "./bootstrap";
import { createApp } from "vue";
import router from "./router";
import App from "./App.vue";
import "@mdi/font/css/materialdesignicons.css";
// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { aliases, mdi } from "vuetify/iconsets/mdi";

// Abilities Settings
import { abilitiesPlugin } from "@casl/vue";
import ability from "./services/ability";

// DataTables Component
import Vue3EasyDataTable from "vue3-easy-data-table";
import "vue3-easy-data-table/dist/style.css";
import "./styles/app.scss";
import "./styles/custom-table.scss";
import BtnSave from "./components/Buttons/BtnSave.vue";

import Loader from "./components/Loader.vue";
import SearchFilter from "./components/SearchFilter.vue"

// Painia Settings
import { createPinia } from "pinia";
const pinia = createPinia();

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: "mdi",
        aliases,
        sets: {
            mdi,
        },
    },
    isRtl: true,
    rtlClasses: ["rtl-app"],
});
const app = createApp(App);
app.use(vuetify);
app.use(router);
app.use(pinia);
app.use(abilitiesPlugin, ability, {
    useGlobalProperties: true,
});
app.component("data-table", Vue3EasyDataTable);
app.component("btn-save", BtnSave);
app.component("Loader", Loader);
app.component("search-filter", SearchFilter);
app.mount("#app");
