import {environment} from '../../environment/environment';
export default [
    {
        name: 'Users',
        path: 'users',
        description: 'Gestión de Usuarios',
        icon: 'pi-user',
        component: () => import('./UsersPage.vue'),
        meta: {
            roles: [environment.rol.ADMINISTRADOR]
        }
    }
]