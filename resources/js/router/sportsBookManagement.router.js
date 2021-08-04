export const sportsBookManagement = [
    {
        name: 'resulting',
        path: '/sportsbook/resulting',
        meta: {
            auth: true
        },
        component: () => import('@views/sportsBook/resulting')
    },

]
