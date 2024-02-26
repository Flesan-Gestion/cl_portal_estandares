import standardRoutes from '../modules/standard/routes';
import authRoutes from '../modules/auth/routes';
import errorRoutes from '../modules/error/routes';

export default [
    {
        path: '/',
        redirect: '/panel/standards'
    },
    {
        path: '/panel',
        redirect: '/panel/standards',
        component: () => import('../layouts/panel/PanelLayout.vue'),
        children: [
            ...standardRoutes
                
        ],
    },
    {
        path: '/auth',
        component: () => import('../layouts/auth/AuthLayout.vue'),
        children: [
            ...authRoutes
        ],
    },
    {
        path: '/error',
        children: [
            ...errorRoutes
        ]
    },
    {
        path: '/:catchAll(.*)',
        redirect: { name: '404' }
    }
]