
import {createRouter, createWebHistory} from "vue-router"
import App from "../components/App.vue"
import NotFound from "../components/NotFound.vue"
import CustomerIndex from "../components/customer/Index.vue"


const routes = [
    {
        path : "/",
        component : App ,
        name : "App" ,
    },
    {
        path : "/customer",
        component : CustomerIndex ,
        name : "CustomerIndex" ,
    },
    {
        path : "/:pathMatch(.*)*",
        component : NotFound ,
        name : "NotFound" ,
    },
]

export default createRouter({
    history : createWebHistory(import.meta.env.BASE_URL),
    routes
})