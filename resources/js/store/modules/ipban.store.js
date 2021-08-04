import axios from "@axios";

const state = {
    ipbans: {},
    ipbanDetail: {},
}
const getters = {

    getterIpbans: state => {
        return state.ipbans
    },
    getterIpbanDetail: state => {
        return state.ipbanDetail
    },
}
const mutations = {
    SET_IPBANS: (state, payload) => {
        state.ipbans = payload
    },
    SET_IPBAN: (state, payload) => {
        state.ipbanDetail = payload
    },
}
const actions = {
    getIpbans({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/ipban', {
                params: { 
                    ip_address: payload.ip_address
                }
            }).then(response => {
                commit('SET_IPBANS', response.data.list)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    updateIpban({commit},payload){
        return new Promise((resolve, reject) => {
            axios.put('user_management/ipban/update/' + payload.id, payload.data).then(response => {
                commit('SET_IPBAN', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    createIpban({commit},payload){
        return new Promise((resolve, reject) => {
            axios.post('user_management/ipban', payload).then(response => {
                commit('SET_IPBAN', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    deleteIpban({commit},payload){
        return new Promise((resolve, reject) => {
            axios.delete('user_management/ipban/delete/' + payload).then(response => {
                commit('SET_IPBAN', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getIpbanDetail({commit},payload){
        return new Promise((resolve, reject) => {
            axios.get('user_management/ipban/' + payload).then( response => {
                commit('SET_IPBAN', response.data.detail)
                if (response.data.status !== true){
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

