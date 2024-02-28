import { createStore } from "vuex";
import loader from "./modules/loader";
import toast from "./modules/toast";
import sidebar from "./modules/sidebar";
import user from "./modules/user";

const store = createStore({
    namespaced:true,
    modules: {
        loader,
        toast,
        sidebar,
        user
    }
})

export default store;