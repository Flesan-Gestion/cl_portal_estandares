import { createStore } from "vuex";
import loader from "./modules/loader";
import toast from "./modules/toast";
import sidebar from "./modules/sidebar";

const store = createStore({
    namespaced:true,
    modules: {
        loader,
        toast,
        sidebar
    }
})

export default store;