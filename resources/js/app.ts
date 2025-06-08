import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './routes.ts';
import 'primeicons/primeicons.css';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
const app = createApp(App);

app.use(pinia);
app.use(router);
app.mount('#app');
// Add logging to verify mounting
console.log('Vue app mounting to #app element');
