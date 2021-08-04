import axios from "@axios";

const state = {
    dashboardData: {}
}

const getters = {
    getterDashboardData: state => {
        return state.dashboardData
    }
}

const mutations = {
    SET_STATIC_CARDS: (state, payload) => {
        state.dashboardData = payload
    },
}

const actions = {
    getDashboardData({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('dashboard').then(response => {
                commit('SET_STATIC_CARDS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    setChanceCurrency({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('dashboard/currency',payload).then(response => {
                // commit('SET_STATIC_CARDS', response.data)
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
