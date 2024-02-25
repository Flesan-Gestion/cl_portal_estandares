import { createStore } from "vuex";
import loader from "./modules/loader";
import toast from "./modules/toast";

const store = createStore({
    namespaced:true,
    modules: {
        loader,
        toast
    }
})

export default store;