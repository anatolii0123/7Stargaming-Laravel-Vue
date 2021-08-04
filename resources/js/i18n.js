import Vue from 'vue'
import VueI18n from 'vue-i18n'
import axios from '@axios'

Vue.use(VueI18n)

let messages = ''

let activeLang  = localStorage.getItem('active_lang')
if (activeLang === null) {
    const langBrowser = navigator.language.split('-')
    activeLang = langBrowser[0]
    localStorage.setItem('active_lang', langBrowser[0])
}

loadLanguageAsync().then(response => {
    let activeLang = localStorage.getItem('active_lang')
    messages = response
    i18n.setLocaleMessage(activeLang,messages[activeLang])
})

/**
 ****
 */

export function chanceMessage(){
    let activeLang = localStorage.getItem('active_lang')
    i18n.setLocaleMessage(activeLang,messages[activeLang])
}

const i18n = new VueI18n({
    locale: activeLang,
    fallbackLocale: activeLang,
})

function loadLanguageAsync() {
    return new Promise((resolve, reject) => {
        axios.get('translates').then(response => {
            let msgs = response.data
            resolve(msgs)
        })
    })
}

export default i18n


