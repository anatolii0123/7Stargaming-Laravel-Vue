import axios from "@axios";

const state = {
    affiliates: {},
    customerGroups: {},
}
const getters = {
    getterAffiliates: state => {
        return state.affiliates
    },
    getterCustomerGroup: state => {
        return state.customerGroups
    }
}
const mutations = {
    SET_AFFILIATES: (state, payload) => {
        state.affiliates = payload
    },
    SET_CUSTOMER_GROUP: (state, payload) => {
        state.customerGroups = payload
    },
}
const actions = {
    getAffiliates({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('filter/affiliates').then(response => {
                commit('SET_AFFILIATES', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    getCustomerGroups({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('filter/customer_groups').then(response => {
                commit('SET_CUSTOMER_GROUP', response.data)
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

