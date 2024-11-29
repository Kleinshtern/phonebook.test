import './bootstrap';

import {createApp, markRaw} from 'vue';
import router from "@/router.js";
import App from "@/App.vue";

import {createPinia} from "pinia";

const pinia = createPinia()

pinia.use(({store}) => {
    store.router = markRaw(router)
})

import '@mdi/font/css/materialdesignicons.css'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives
})

const app = createApp(App)

app.use(vuetify)
app.use(router)
app.use(pinia)
app.mount('#app');
