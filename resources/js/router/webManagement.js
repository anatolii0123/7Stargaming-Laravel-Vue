export const webManagement = [
    {
        name: 'announcements',
        path: '/web-management/announcements',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/announcements')
    },

    {
        name: 'pages',
        path: '/web-management/pages',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/pages')
    },

    {
        name: 'promotions',
        path: '/web-management/promotions',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/promotions')
    },

    {
        name: 'slider',
        path: '/web-management/slider',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/slider')
    },

    {
        name: 'background',
        path: '/web-management/background',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/background')
    },

    {
        name: 'gameProviderVisuals',
        path: '/web-management/game-provider-visuals',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/gameProviderVisuals')
    },

    {
        name: 'fileManager',
        path: '/web-management/file-manager',
        meta: {
            auth: true
        },
        component: () => import('@views/webManagement/fileManager')
    },
]
