import './bootstrap';
import App from './App.vue';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import router from './routes/router';
import setGlobalComponents from './components';
import setGlobalProperties from './config/globalproperties.config';

const app = createApp(App);
app.use(router);
app.use(PrimeVue); // Plugin de vue
app.use(ToastService); // Plugin para los Toasts
setGlobalComponents(app);
setGlobalProperties(app);
app.mount('#app');