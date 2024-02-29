import { createStore } from "vuex";
import loader from "./modules/loader";
import toast from "./modules/toast";
import sidebar from "./modules/sidebar";
import user from "./modules/user";
import confirmation from "./modules/confirmation";

const store = createStore({
    namespaced:true,
    modules: {
        loader,
        toast,
        sidebar,
        user,
        confirmation
    }
})

export default store;