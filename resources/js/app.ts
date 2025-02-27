import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./layouts/App.vue";
import router from "./routes";

const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.mount("#app");
