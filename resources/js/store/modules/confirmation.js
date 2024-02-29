import { createStore } from "vuex";

const modalConfirmation = {
    namespaced: true,
    state: {
        visible: false,
        header: '¿Estás seguro?',
        labelAccept: 'Sí, estoy seguro',
        labelReject: 'No, no estoy seguro',
        message: '',
        accept: () => { },
        reject: () => { }
    },
    actions: {
    },
    mutations: {
        show(state, config) {
            state.visible = true;
            state.header = config.header ? config.header : state.header;
            state.message = config.message ? config.message : state.message;
            state.labelAccept = config.labelAccept ? config.labelAccept : state.labelAccept;
            state.labelReject = config.labelReject ? config.labelReject : state.labelReject;
            state.accept = config.accept;
            state.reject = config.reject;
        },
        hidden(state) {
            state.visible = false;
            state.header = '¿Estás seguro?';
            state.message = '';
            state.accept = () => { };
            state.reject = () => { };
        }
    },
    getters: {
    }
}

export default modalConfirmation;