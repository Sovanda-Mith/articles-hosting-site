import "./bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./routes.ts";

const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.mount("#app");
// Add logging to verify mounting
console.log("Vue app mounting to #app element");
