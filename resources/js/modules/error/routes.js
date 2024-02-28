export default [
    {
        name: '404',
        path: '404',
        component: () => import('./404.vue')
    },
    {
        name: '403',
        path: '403',
        component: () => import('./403.vue')
    },
    {
        name: '422',
        path: '422',
        component: () => import('./422.vue')
    },
]