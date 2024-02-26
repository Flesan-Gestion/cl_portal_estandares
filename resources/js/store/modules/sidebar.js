import { createStore } from "vuex";

const sidebar = {
    namespaced: true,
    state: {
        siteClass: '',
        currentRoute: null
    },
    actions: {

    },
    mutations: {
        setSiteClass(state, value) {
            state.siteClass = value;
            window.localStorage.setItem('siteClass', value);
        },
        setCurrentRoute(state, value){
            window.localStorage.setItem('currentRoute', value)
            state.currentRoute = value;
        }
    },
    getters: {

    }
}

export default sidebar;