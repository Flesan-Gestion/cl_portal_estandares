import { createStore } from "vuex";

const user = {
    namespaced: true,
    state: {
        data: null
    },
    actions: {

    },
    mutations: {
        set(state, user) {
            state.data = {
                id: user.id_aplicacion_usuario,
                email: user.username,
                fullname: user.name,
                name: user.nombres,
                lastname: user.apellidos,
                dni: user.dni,
                avatar: user.avatar,
                country: user.pais,
                rol: user.rol
            }
        }
    },
    getters: {

    }
}

export default user;