export const riskManagement = [
    {
        name: 'liveStreaming',
        path: '/risk-management/live-streaming',
        meta: {
            auth: true
        },
        component: () => import('@views/riskManagement/liveStreaming')
    },

    {
        name: 'couponsRisk',
        path: '/risk-management/coupons-risk',
        meta: {
            auth: true
        },
        component: () => import('@views/riskManagement/couponsRisk')
    },

    {
        name: 'couponsRemainingForOneSpade',
        path: '/risk-management/coupons-remaining-for-one-spade',
        meta: {
            auth: true
        },
        component: () => import('@views/riskManagement/couponsRemainingForOneSpade')
    },

    {
        name: 'openBets',
        path: '/risk-management/open-bets',
        meta: {
            auth: true
        },
        component: () => import('@views/riskManagement/openBets')
    },

]
