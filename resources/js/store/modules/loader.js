import { createStore } from "vuex";

const loader = {
    namespaced: true,
    state: {
        visible: false
    },
    actions: {

    },
    mutations: {
        show(state){
            state.visible = true
        },
        hidden(state){
            state.visible = false
        }
    },
    getters: {

    }
}

export default loader;