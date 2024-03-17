import _ from 'lodash';
window._ = _;
import store from './store/index';
import { Utilities } from './shared/classes/Utilities';
import { ToastTypeMessage } from './shared/constants/toast-type-message';
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// Interceptor para las peticiones
axios.interceptors.request.use(
    function (config) {

        config.headers['Authorization'] = 'Bearer ' + store.state.user.token;

        return config;
    },
    function (error) {
        // Manejo de errores en las peticiones
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    (response) => {
        // Hacer algo con la respuesta exitosa
        return response;
    },
    (error) => {
        Utilities.hiddenLoader();
        Utilities.genToast(ToastTypeMessage.OPERATION_ERROR);
        return Promise.reject(error);
    }
);