import axios from "@axios";

const state = {
    languages: null
}
const getters = {
    getterLanguages: state => {
        return state.languages
    },
}
const mutations = {
    SET_LANGUAGES: (state, payload) => {
        state.languages = payload
    },
}
const actions = {
    getLanguages({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('languages').then(response => {
                commit('SET_LANGUAGES', response.data)
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

