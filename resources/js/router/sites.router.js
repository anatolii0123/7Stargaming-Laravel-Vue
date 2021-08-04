export const sites = [
    {
        name: 'sites',
        path: '/sites/my-sites',
        meta: {
            auth: true
        },
        component: () => import('@views/sites/mySites')
    },

    {
        name: 'createSite',
        path: '/sites/create-site',
        meta: {
            auth: true
        },
        component: () => import('@views/sites/createSite')
    },

    {
        name: 'siteDomains',
        path: '/sites/domains',
        meta: {
            auth: true
        },
        component: () => import('@views/sites/siteDomains')
    },

]
