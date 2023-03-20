import "../../js/bootstrap";

import { createApp } from "vue";
import { Quasar } from "quasar";
import quasarLang from "quasar/lang/ar";
import quasarIconSet from "quasar/icon-set/mdi-v6";
import notify from "quasar/src/plugins/notify";

// Import icon libraries
import "@quasar/extras/material-icons/material-icons.css";
import "@quasar/extras/mdi-v6/mdi-v6.css";

import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

// A few examples for animations from Animate.css:
import "@quasar/extras/animate/zoomIn.css";
import "@quasar/extras/animate/zoomOut.css";
// import '@quasar/extras/animate/rollOut.css'
// import '@quasar/extras/animate/rollIn.css'
import "@quasar/extras/animate/fadeIn.css";
// import '@quasar/extras/animate/fadeOutRight.css'
import "@quasar/extras/animate/fadeOut.css";

// Import Quasar css
import "quasar/src/css/index.sass";
// import 'animate.css';
import "../css/app.css";

// Assumes your root component is App.vue
// and placed in same folder as main.js
import App from "./App.vue";
import router from "../../js/router";

// Abilities Settings
import { abilitiesPlugin } from "@casl/vue";
import ability from "../../js/services/ability";

const myApp = createApp(App);

myApp.use(Quasar, {
    plugins: { notify }, // import Quasar plugins and add here
    lang: quasarLang,
    iconSet: quasarIconSet,
    build: {
        rtl: true,
    },
    animations: ["zoomIn"],
});

// Assumes you have a <div id="app"></div> in your index.html
myApp.use(router);
myApp.use(pinia);
myApp.use(abilitiesPlugin, ability, {
    useGlobalProperties: true,
});
myApp.mount("#app");
