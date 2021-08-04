import axios from "@axios";

const state = {
    activeLang: null,
    navbarChance: null,
    customJS: null,
    customCSS: null,
    socialMedia: null,
    generalSettings: null,
    paymentMethods: null,
    updatePaymentMethod: null,
    paymentMethodCustomFormEdit: {},
    paymentMethodGroups: null,
    currencies: null,
    availableCurrencies: {},
    gameProviders: null,
}
const getters = {
    activeLang: state => {
        return state.activeLang
    },
    navbarChance: state => {
        return state.navbarChance
    },
    getterCustomJS: state => {
        return state.customJS
    },
    getterCustomCSS: state => {
        return state.customCSS
    },
    getterSocialMedia: state => {
        return state.socialMedia
    },
    getterGeneralSettings: state => {
        return state.generalSettings
    },
    getterPaymentMethods: state => {
        return state.paymentMethods
    },
    getterUpdatePaymentMethod: state => {
        return state.updatePaymentMethod
    },
    getterPaymentMethodCustomFormEdit: state => {
        return state.paymentMethodCustomFormEdit
    },
    getterPaymentMethodGroups: state => {
        return state.paymentMethodGroups
    },
    getterCurrencies: state => {
        return state.currencies
    },
    getterAvailableCurrencies: state => {
        return state.availableCurrencies
    },
    getterGameProviders: state => {
        return state.gameProviders
    }
}
const mutations = {
    SET_ACTIVE_LANG: (state, payload) => {
        state.activeLang = payload
    },
    SET_NAVBAR_CHANCE: (state, payload) => {
        state.navbarChance = payload
    },
    SET_CUSTOM_JS: (state, payload) => {
        state.customJS = payload
    },
    SET_CUSTOM_CSS: (state, payload) => {
        state.customCSS = payload
    },
    SET_SOCIAL_MEDIA: (state, payload) => {
        state.socialMedia = payload
    },
    SET_GENERAL_SETTINGS: (state, payload) => {
        state.generalSettings = payload
    },
    SET_PAYMENT_METHODS: (state, payload) => {
        state.paymentMethods = payload
    },
    SET_UPDATE_PAYMENT_METHOD: (state, payload) => {
        if(payload !== null){
            state.updatePaymentMethod = {
                id: payload.id,
                form: payload.form,
                lang: payload.lang,
                group_id: payload.group.id,
                priority: payload.priority,
                description: payload.description,
                deposit: payload.deposit,
                withdraw: payload.withdraw,
                min_deposit: payload.min_deposit,
                min_withdraw: payload.min_withdraw,
                max_deposit: payload.max_deposit,
                max_withdraw: payload.max_withdraw,
                image: payload.image,
                fee: payload.fee,
                time: payload.time,
                session_id: payload.session_id,
                api_id: payload.api_id,
                api_key: payload.api_key,
                blank: payload.blank,
                status: payload.status
            }
        }else{
            state.updatePaymentMethod = null
        }

    },
    SET_PAYMENT_METHOD_CUSTOM_FORM_EDIT: (state, payload) => {
        state.paymentMethodCustomFormEdit = payload
    },
    SET_PAYMENT_METHOD_GROUPS: (state, payload) => {
        state.paymentMethodGroups = payload
    },
    SET_CURRENCIES: (state, payload) => {
        state.currencies = payload
    },
    SET_AVAILABLE_CURRENCIES: (state, payload) => {
        state.availableCurrencies = payload
    },
    SET_GAME_PROVIDERS: (state, payload) => {
        state.gameProviders = payload
    }
}
const actions = {
    getCustomJS({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/custom_js').then(response => {
                commit('SET_CUSTOM_JS', response.data.detail)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    updateCustomJS({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('settings/custom_js', payload).then(response => {
                // commit('SET_CUSTOM_JS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getCustomCSS({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/custom_css').then(response => {
                commit('SET_CUSTOM_CSS', response.data.detail)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    updateCustomCSS({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('settings/custom_css', payload).then(response => {
                // commit('SET_CUSTOM_CSS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getSocialMedia({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/social_media').then(response => {
                commit('SET_SOCIAL_MEDIA', response.data.detail)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    updateSocialMedia({commit}, payload) {
        return new Promise((resolve, reject) => {
            // console.log(payload);
            axios.put('settings/social_media', payload).then(response => {
                // commit('SET_CUSTOM_CSS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getGeneralSettings({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/general_settings').then(response => {
                commit('SET_GENERAL_SETTINGS', response.data.detail)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    updateGeneralSettings({commit}, payload) {
        return new Promise((resolve, reject) => {
            // console.log(payload);
            axios.put('settings/general_settings', payload).then(response => {
                // commit('SET_CUSTOM_CSS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getPaymentMethods({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/payment_methods', {
                params: payload
            }).then(response => {
                commit('SET_PAYMENT_METHODS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    setPaymentMethodStatus({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('settings/payment_methods/update_status/' + payload.id, {
                status: payload.status
            } ).then(response => {
                // commit('SET_PAYMENT_METHODS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getPaymentMethodGroups({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/payment_methods/groups').then(response => {
                commit('SET_PAYMENT_METHOD_GROUPS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    createPaymentMethod({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.post('settings/payment_methods', payload).then(response => {
                // commit('SET_PAYMENT_METHOD_GROUPS', response.data)
                if (response.data.status === false){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    updatePaymentMethod({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('settings/payment_methods/update/' + payload.id, payload.data).then(response => {
                // commit('SET_PAYMENT_METHOD_GROUPS', response.data)
                if (response.data.status === false){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    getCurrencies({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/currencies').then(response => {
                commit('SET_CURRENCIES', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    setCurrencyStatus({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('settings/currencies/update/' + payload.id, {
                status: payload.status
            } ).then(response => {
                if (response.data.status === false){
                    reject(response.data.errors)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getAvailableCurrencies({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/currencies/available_currencies').then(response => {
                commit('SET_AVAILABLE_CURRENCIES', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    createCurrency({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.post('settings/currencies', payload).then(response => {
                // commit('SET_PAYMENT_METHOD_GROUPS', response.data)
                if (response.data.status === false){
                    reject(response.data)
                }
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    getGameProviders({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.get('settings/game_providers', {
                params: payload
            }).then(response => {
                commit('SET_GAME_PROVIDERS', response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },

    setGameProviderStatus({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.put('settings/game_providers/update', payload ).then(response => {
                // commit('SET_PAYMENT_METHODS', response.data)
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

