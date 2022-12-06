import './bootstrap';
import "bootstrap/dist/css/bootstrap.min.css"

import {createApp} from "vue"
import App from "./components/App.vue"
import router from "./router"
import store from "./store"
import Btn from "./components/sub/Btn.vue"

const app = createApp(App)
app.component("Btn" , Btn)
app.use(router)
    .use(store)
    .mount("#app")
