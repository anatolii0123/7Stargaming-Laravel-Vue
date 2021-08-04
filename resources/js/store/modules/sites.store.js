import axios from "@axios";

const state = {
    sites: {},
    activeSite: null,
    siteLimits: {},
    customerInfo:[],
}
const getters = {
    sites: state => {
        return state.users
    },
    activeSite: state => {
        return state.activeSite
    },
    siteLimits: state => {
        return state.siteLimits
    },
    getterCustomerInfo: state => {
        return state.customerInfo
    },

}
const mutations = {
    SET_SITES: (state, payload) => {
        state.sites = payload
    },
    SET_ACTIVE_SITES: (state, payload) => {
        state.activeSite = payload
    },
    SET_SITE_LIMITS: (state, payload) => {
        state.siteLimits = payload
    },
    SET_CUSTOMER_INFO: (state, payload) => {
        state.customerInfo = payload
    },
}
const actions = {
    getSites({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/users').then(response => {
                commit('SET_SITES', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    getSiteLimits({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('site/limits').then(response => {
                commit('SET_SITE_LIMITS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    getCustomerInfo({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('search', {
                params:{q:payload}
            }).then(response => {
                commit('SET_CUSTOMER_INFO', response.data.results)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

