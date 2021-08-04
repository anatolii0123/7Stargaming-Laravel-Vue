/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue').default;

import Vue from 'vue'
import App from './App.vue';
import store from "./store/store";

// Number Format
import numeral from 'numeral';
import numFormat from 'vue-filter-number-format';

// Bootstrap Vue Integration
import {BootstrapVue} from 'bootstrap-vue'

Vue.use(BootstrapVue)
// vue-notification

//VueApexCharts
import VueApexCharts from 'vue-apexcharts'

Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)
//VueApexCharts

import Notifications from 'vue-notification'
// vue-notification

import router from "./router";
import i18n from "./i18n";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


/**
 * Global fonksiyonlar
 */

Vue.mixin({
    methods: {
        // Açılır menü pathlerine göre active clası verme
        isNavActive: function (item) {
            if (this.$route.fullPath.split('/')[1] === item) {
                return true
            }
            return false
        },
        formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        },
        toDatetimeLocal() {
            var
                date = new Date(),
                ten = function (i) {
                    return (i < 10 ? '0' : '') + i;
                },
                YYYY = date.getFullYear(),
                MM = ten(date.getMonth() + 1),
                DD = ten(date.getDate()),
                HH = ten(date.getHours()),
                II = ten(date.getMinutes()),
                SS = ten(date.getSeconds())
            ;
            return YYYY + '-' + MM + '-' + DD + 'T' +
                HH + ':' + II;
        },
        toDatetimeLocalCustomHour(hour) {
            var
                date = new Date(),
                ten = function (i) {
                    return (i < 10 ? '0' : '') + i;
                },
                YYYY = date.getFullYear(),
                MM = ten(date.getMonth() + 1),
                DD = ten(date.getDate());
            return YYYY + '-' + MM + '-' + DD + 'T' +
                hour;
        },
        toCamelCase(str) {
            var arr = str.match(/[a-z]+|\d+/gi);
            return arr.map((m, i) => {
                let low = m.toLowerCase();
                if (i != 0) {
                    low = low.split('').map((s, k) => k == 0 ? s.toUpperCase() : s).join``
                }
                return low;
            }).join``;
        }
    }
})

// global fonksiyon end

/**
 * dil ayaları.
 */

Vue.use(Notifications);

Vue.filter('uppercase', function (value) {
    if (typeof value === "string") {
        return value.toUpperCase()
    }
    return value
})

Vue.filter('numFormat', numFormat(numeral));

const app = new Vue({
    el: '#app',
    store,
    i18n,
    router,
    render: h => h(App),
});
