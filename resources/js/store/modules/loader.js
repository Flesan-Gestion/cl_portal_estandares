import { createStore } from "vuex";

const loader = {
    namespaced: true,
    state: {
        visible: false,
        message: null
    },
    actions: {

    },
    mutations: {
        show(state, message = null){
            state.visible = true;
            state.message = message;
        },
        hidden(state){
            state.visible = false;
            state.message = null;
        }
    },
    getters: {

    }
}

export default loader;