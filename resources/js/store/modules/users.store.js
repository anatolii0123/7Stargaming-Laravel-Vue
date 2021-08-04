import axios from "@axios";

const state = {
    userData: {},
    onlineCustomerData: {},
}
const getters = {
    getterUserData: state => {
        return state.userData
    },
    getterOnlineCustomerData: state => {
        return state.onlineCustomerData
    },
}
const mutations = {
    SET_USER: (state, payload) => {
        state.userData = payload
    },
    SET_ONLINE_CUSTOMER: (state, payload) => {
        state.onlineCustomerData = payload
    },
}
const actions = {
    getUserData({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/users', {
                params: payload
            }).then(response => {
                commit('SET_USER', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    getOnlineCustomerData({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/online_customers', {
                params: payload
            }).then(response => {
                commit('SET_ONLINE_CUSTOMER', response.data.list)
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

