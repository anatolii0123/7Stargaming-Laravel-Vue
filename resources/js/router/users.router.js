export const userManagement = [
    {
        name: 'userManagement',
        path: '/users/list',
        meta: {
            auth: true
        },
        component: () => import('@views/users/list')
    },

    {
        name: 'customerGroups',
        path: '/users/customer-groups',
        meta: {
            auth: true
        },
        component: () => import('@views/users/groups/index')
    },

    {
        name: 'customerBankAccounts',
        path: '/users/bank-accounts',
        meta: {
            auth: true
        },
        component: () => import('@views/users/customerBankAccounts')
    },

    {
        name: 'customerOnline',
        path: '/users/online-customers',
        meta: {
            auth: true
        },
        component: () => import('@views/users/customerOnline')
    },

    {
        name: 'customerNotes',
        path: '/users/customer-notes',
        meta: {
            auth: true
        },
        component: () => import('@views/users/customerNotes')
    },

    {
        name: 'customerLogs',
        path: '/users/customer-logs',
        meta: {
            auth: true
        },
        component: () => import('@views/users/customerLogs')
    },

    {
        name: 'operator',
        path: '/users/operator',
        meta: {
            auth: true
        },
        component: () => import('@views/users/operator')
    },

    {
        name: 'customerMultiIp',
        path: '/users/multi-ip',
        meta: {
            auth: true
        },
        component: () => import('@views/users/multiIp')
    },

    {
        name: 'customerIpBans',
        path: '/users/ip-bans',
        meta: {
            auth: true
        },
        component: () => import('@views/users/ipban/index')
    },

    {
        path: '/users/:id',
        meta: {
            auth: true
        },
        component: () => import('@views/users/userDetail/layout'),
        children: [
            {
                name: 'userDetail',
                path: '',
                component: () => import('@views/users/userDetail/default'),
            },
            {
                path: 'information-update',
                name: 'informationUpdate',
                component: () => import('@views/users/userDetail/informationUpdate'),
            },
            {
                path: 'coupons',
                name: 'userCoupons',
                component: () => import('@views/users/userDetail/coupons'),
            },
            {
                path: 'bonuses',
                name: 'userBonuses',
                component: () => import('@views/users/userDetail/bonuses'),
            },
            {
                path: 'discount',
                name: 'userDiscount',
                component: () => import('@views/users/userDetail/discount'),
            },
            {
                path: 'limits',
                name: 'userLimits',
                component: () => import('@views/users/userDetail/limits'),
            },
            {
                path: 'messages',
                name: 'userMessages',
                component: () => import('@views/users/userDetail/messages'),
            },
            {
                path: 'document-management',
                name: 'userDocumentManagement',
                component: () => import('@views/users/userDetail/documentManagement'),
            },
            {
                path: 'transactions',
                name: 'userTransactions',
                component: () => import('@views/users/userDetail/transactions'),
            },
            {
                path: 'financial-statistics',
                name: 'userFinancialStatistics',
                component: () => import('@views/users/userDetail/financialStatistics'),
            },
            {
                path: 'casino-moves',
                name: 'userCasinoMoves',
                component: () => import('@views/users/userDetail/casinoMoves'),
            },
            {
                path: 'slot-moves',
                name: 'userSlotMoves',
                component: () => import('@views/users/userDetail/slotMoves'),
            },
            {
                path: 'score-prediction-moves',
                name: 'userScorePredictionMoves',
                component: () => import('@views/users/userDetail/scorePredictionMoves'),
            },
            {
                path: 'logs',
                name: 'userLogs',
                component: () => import('@views/users/userDetail/logs'),
            }

        ]
    },
]
