import {tokenAlive, jwtDecrypt} from "../../auth/functions";

const state = {
    authData: {
        token: "",
        tokenExp: "",
        userId: "",
    },
}

const getters = {
    isTokenActive(state) {
        if (!state.authData.tokenExp) {
            return false;
        }
        return tokenAlive(state.authData.tokenExp);
    },
    getterAuthData(state) {
        return state.authData
    }
}

const mutations = {
    SAVE_TOKEN_DATA: (state, payload) => {
        const jwtDecodedValue = jwtDecrypt(payload.access_token);
        const newTokenData = {
            token: payload.access_token,
            tokenExp: jwtDecodedValue.exp,
            userId: jwtDecodedValue.sub
        };
        state.authData = newTokenData;
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
}


