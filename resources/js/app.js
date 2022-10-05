import "./bootstrap";
import "../sass/app.scss";
import '@vueform/multiselect/themes/default.css'
import { createApp } from "vue";
import App from "./App.vue";

import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

import TableIcon from './components/widgets/TableIcon.vue'


import router from "./router";
import Loader from "./components/core/Loader.vue";
import Content from "./components/core/Content.vue";
import DataTable from "./components/table/DataTable.vue";
import GlobalMixins from "./mixins/global";
import EventHub from "./components/EventHubPlugin/EventHub.vue";
import * as bootstrap from "./bootstrap";
import BtnCreate from "./components/buttons/BtnCreate.vue";
import VueHtmlToPaper from "./vueHtmlToPaper"

import { createPinia } from 'pinia'
const pinia = createPinia()
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import { abilitiesPlugin } from "@casl/vue";
import ability from "./services/ability";

const options2 = {
    position: "top-right",
    timeout: 2000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: true,
    transition: "Vue-Toastification__fade",
};
const options3 = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
      'scrollbars=yes'
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: true, // if false, the window will not close after printing
    windowTitle: window.document.title, // override the window title
  }
const app = createApp(App);
app.use(router);
app.use(Toast, options2);
// app.use(bootstrap);
app.use(pinia)
app.use(abilitiesPlugin, ability, {
    useGlobalProperties: true,
});
app.use(GlobalMixins);
app.use(VueHtmlToPaper, options3);
app.component('EasyDataTable', Vue3EasyDataTable);
app.component("event-hub", EventHub);
app.component("Content", Content);
app.component("DataTable", DataTable);
app.component("Loader", Loader);
app.component("btn-create", BtnCreate);
app.component("table-icon", TableIcon);
app.mount("#app");
