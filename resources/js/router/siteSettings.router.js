export const siteSetting = [
    {
        name: 'generalSettings',
        path: '/site-settings/general',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/generalSettings')
    },

    {
        name: 'socialMedia',
        path: '/site-settings/social-media',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/socialMedia')
    },

    {
        name: 'customCss',
        path: '/site-settings/custom-css',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/customCss')
    },

    {
        name: 'customJavaScript',
        path: '/site-settings/custom-javascript',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/customJavaScript')
    },

    {
        name: 'currencies',
        path: '/site-settings/currencies',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/currencies')
    },

    {
        name: 'paymentMethods',
        path: '/site-settings/payment-methods',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/paymentMethods')
    },

    {
        name: 'translates',
        path: '/site-settings/translates',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/translates')
    },

    {
        name: 'bonuses',
        path: '/site-settings/bonuses',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/bonuses')
    },
    {
        name: 'gameProviders',
        path: '/site-settings/game-providers',
        meta: {
            auth: true
        },
        component: () => import('@views/siteSetting/gameProviders')
    },



]
