export const betting = [
    {
        name: 'betting',
        path: '/betting',
        meta: {
            auth: true
        },
        component: () => import('@views/betting/index')
    },

]
