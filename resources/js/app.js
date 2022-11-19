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
import SearchFilter from "./components/SearchFilter.vue";
import DeleteItem from "./components/dialog/DeleteItem.vue";
//icons
import DeleteIcon from "./components/icons/DeleteIcon.vue";
import EditIcon from "./components/icons/EditIcon.vue";
import ShowIcon from "./components/icons/ShowIcon.vue";
import ExportMenu from "./components/dialog/ExportMenu.vue";
import ImportMenu from "./components/dialog/ImportMenu.vue";
import MainPage from "./components/pages/MainPage.vue"

import VueHtmlToPaper from "./plugins/vueHtmlToPaper";
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

const options = {
    name: "_blank",
    specs: ["fullscreen=yes", "titlebar=yes", "scrollbars=yes"],
    timeout: 1000, // default timeout before the print window appears
    autoClose: true, // if false, the window will not close after printing
    windowTitle: window.document.title, // override the window title
};

const app = createApp(App);
app.use(vuetify);
app.use(router);
app.use(pinia);
app.use(abilitiesPlugin, ability, {
    useGlobalProperties: true,
});
app.use(VueHtmlToPaper, options);
app.component("data-table", Vue3EasyDataTable);
app.component("btn-save", BtnSave);
app.component("Loader", Loader);
app.component("search-filter", SearchFilter);
app.component("delete-item", DeleteItem);

app.component("edit-icon", EditIcon);
app.component("delete-icon", DeleteIcon);
app.component("show-icon", ShowIcon);

app.component("main-page", MainPage);
app.component("export-menu", ExportMenu);
app.component("import-menu", ImportMenu);
app.mount("#app");
