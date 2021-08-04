export const finance = [
    {
        name: 'financeDeposit',
        path: '/finance/deposit',
        meta: {
            auth: true
        },
        component: () => import('@views/finance/financeDeposit')
    },

    {
        name: 'financeWithdraw',
        path: '/finance/withdraw',
        meta: {
            auth: true
        },
        component: () => import('@views/finance/financeWithdraw')
    },

    {
        name: 'financeAccounting',
        path: '/finance/accounting',
        meta: {
            auth: true
        },
        component: () => import('@views/finance/financeAccounting')
    },

]
