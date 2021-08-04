export const coupons = [
    {
        name: 'couponsList',
        path: '/coupons/list',
        meta: {
            auth: true
        },
        component: () => import('@views/coupons/list')
    },

    {
        name: 'couponsSettings',
        path: '/coupons/settings',
        meta: {
            auth: true
        },
        component: () => import('@views/coupons/couponsSettings')
    },

]
