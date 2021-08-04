import axios from "@axios";

const state = {
    userNavInfo: null,
}
const getters = {
    getterUserNavInfo: state => {
        return state.userNavInfo
    },

}
const mutations = {
    SET_USER_NAV_INFO: (state, payload) => {
        state.userNavInfo = payload
    },
}
const actions = {
    getUserNavInfo({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/profile/info/' + payload).then(response => {
                commit('SET_USER_NAV_INFO', response.data)
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

