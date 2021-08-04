export const invoices = [
    {
        name: 'invoices',
        path: '/invoices/list',
        meta: {
            auth: true
        },
        component: () => import('@views/invoices/list')
    },

    {
        name: 'paymentTransactions',
        path: '/invoices/payment-transactions',
        meta: {
            auth: true
        },
        component: () => import('@views/invoices/paymentTransactions')
    },

    {
        name: 'limitRequests',
        path: '/invoices/limit-requests',
        meta: {
            auth: true
        },
        component: () => import('@views/invoices/limitRequests')
    },

]
