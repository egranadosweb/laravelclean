import {createStore} from "vuex"
import CustomerStore from "./modules/customer.js"


export default createStore({
    modules : {
        customer : CustomerStore,
        
    }
})