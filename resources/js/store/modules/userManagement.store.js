import axios from "@axios";

const state = {
    groups: {},
    group: {},
    multiIp: ''
}
const getters = {

    groups: state => {
        return state.groups
    },
    multiIp: state => {
        return state.multiIp
    },
}
const mutations = {
    SET_GROUPS: (state, payload) => {
        state.groups = payload
    },
    SET_GROUP: (state, payload) => {
        state.group = payload
    },
    SET_MULTI_IP: (state, payload) => {
        state.multiIp = payload
    },
}
const actions = {
    getGroups({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/customer_groups').then(response => {
                commit('SET_GROUPS', response.data.list)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    updateGroup({commit},payload){
        return new Promise((resolve, reject) => {
            axios.put('user_management/customer_groups/update/' + payload.id, payload.data).then(response => {
                commit('SET_GROUP', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    createGroup({commit},payload){
        return new Promise((resolve, reject) => {
            axios.post('user_management/customer_groups', payload).then(response => {
                commit('SET_GROUP', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    deleteGroup({commit},payload){
        return new Promise((resolve, reject) => {
            axios.delete('user_management/customer_groups/delete/' + payload).then(response => {
                commit('SET_GROUP', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    /**
     * multiIp Action
     */
    getMultiIp({commit},payload){
        return new Promise((resolve, reject) => {
            axios.get('user_management/multi_ips', {
                params: payload
            }).then( response => {
                commit('SET_MULTI_IP', response.data)
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

