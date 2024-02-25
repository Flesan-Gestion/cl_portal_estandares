export default [
    {
        path: '/',
        redirect: '/auth'
    },
    {
        path: '/panel',
        children: [
            {
                name: 'Standars',
                path: 'standards',
                component: () => import('../modules/standard/StandardPage.vue')
            }
        ],
    },
    {
        path: '/auth',
        component: () => import('../layouts/auth/AuthLayout.vue'),
        children: [
            {
                name: 'Login',
                path: '/',
                component: () => import('../modules/auth/LoginPage.vue')
            }
        ],
    },
    {
        path: '/error',
        children: [
            {
                name: '404',
                path: '404',
                component: () => import('../modules/error/404.vue')
            }
        ]
    },
    {
        path: '/:catchAll(.*)',
        redirect: { name: '404' }
    }
]