import axios from "@axios";

const state = {
    customerSettings: {},
}
const getters = {
    getterCouponSettings: state => {
        return state.customerSettings
    },
}
const mutations = {
    SET_COUPON_SETTINGS: (state, payload) => {
        state.customerSettings = payload
    },
}
const actions = {
    getCouponSettings({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('coupons/coupon_settings').then(response => {
                commit('SET_COUPON_SETTINGS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    updateCouponSettings({commit}, payload){
        return new Promise((resolve, reject) => {
            axios.put('coupons/coupon_settings',payload).then(response => {
                if (response.data.status === false){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

