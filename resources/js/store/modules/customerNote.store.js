import axios from "@axios";

const state = {
    customerNotes: {},
    customerNoteDetail: {},
}
const getters = {

    getterCustomerNotes: state => {
        return state.customerNotes
    },
    getterCustomerNoteDetail: state => {
        return state.customerNoteDetail
    },
}
const mutations = {
    SET_CUSTOMER_NOTES: (state, payload) => {
        state.customerNotes = payload
    },
    SET_CUSTOMER_NOTE: (state, payload) => {
        state.customerNoteDetail = payload
    },
}
const actions = {
    getCustomerNotes({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('user_management/notes', {
                params: payload
            }).then(response => {
                commit('SET_CUSTOMER_NOTES', response.data.list)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    updateCustomerNote({commit},payload){
        return new Promise((resolve, reject) => {
            axios.put('user_management/notes/update/' + payload.id, payload.data).then(response => {
                commit('SET_CUSTOMER_NOTE', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    createCustomerNote({commit},payload){
        return new Promise((resolve, reject) => {
            axios.post('user_management/notes', payload).then(response => {
                commit('SET_CUSTOMER_NOTE', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    deleteCustomerNote({commit},payload){
        return new Promise((resolve, reject) => {
            axios.delete('user_management/notes/delete/' + payload).then(response => {
                commit('SET_CUSTOMER_NOTE', response.data.list)
                if (response.data.status !== true){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getCustomerNoteDetail({commit},payload){
        return new Promise((resolve, reject) => {
            axios.get('user_management/notes/' + payload).then( response => {
                commit('SET_CUSTOMER_NOTE', response.data.detail)
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

