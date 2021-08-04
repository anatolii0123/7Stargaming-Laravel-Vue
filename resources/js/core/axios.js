import axios from 'axios'

const systemLanguage = localStorage.getItem('active_lang')

const axiosIns = axios.create({
    // You can add your headers here
    // ================================
    baseURL: 'https://backoffice.betmodule.com/api/',
    // baseURL: '/api/',
    // timeout: 1000,
    headers: {'ActiveLang': systemLanguage}
})

axiosIns.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (401 === error.response.status) {
        window.location.href = '/login'
    }

    return Promise.reject(error.response.data)

})

export default axiosIns
