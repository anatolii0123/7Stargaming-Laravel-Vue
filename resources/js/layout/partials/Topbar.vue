<template>
    <!-- Topbar Start -->
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-end mb-0">

                <li class="d-none d-lg-block">
                    <div class="app-search">
                        <div class="app-search-box dropdown">
                            <div class="input-group">
                                <input type="search" @keyup="getCustomerInfo()" v-model="searchCustomerText" autocomplete="off" class="form-control btn-top-search-popup" id="top-search" placeholder="Search...">
                                <button class="btn input-group-text" type="button" @click="getCustomerInfo">
                                    <i class="fe-search"></i>
                                </button>
                            </div>

                            <div class="dropdown-menu dropdown-lg search-dropdown-popup" id="search-dropdown" style="max-height:400px; overflow-y:auto; overflow-x:hidden">

                                <div
                                    v-for="item in this.customerInfo"
                                    class="notification-list"
                                >
                                    <div class="dropdown-header noti-title" >
                                        <h5 class="text-overflow mb-2 text-uppercase" style="color:#6658dd">{{item.text}}</h5>
                                    </div>
                                    <!-- item-->
                                    <a
                                        v-for="child in item.children"
                                        v-bind:key="child.id"
                                        v-bind:href="item.text == 'Customers'? child.url:child.id"
                                        class="dropdown-item notify-item"
                                    >
                                        <div class="d-flex align-items-start">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">{{child.text}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="d-none d-lg-block" v-if="activeSite">
                    <div class="app-search" style="min-width: 175px;">
                        <div class="app-search-box">
                            <div class="input-group">
                                <select v-model="activeSite" class="form-select form-control" id="siteSelector"
                                        @change="chanceSites($event)">
                                    <option v-for="option in sites" v-bind:key="option.id" v-bind:value="option.id">
                                        #{{ option.id }} - {{ option.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                       href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img :src="setLanguageImageSrc(activeLangDefault.sort)" alt="user-image" height="16">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item" v-for="item in systemLanguages"
                           @click="chanceLang(item.sort)">
                            <img :src="setLanguageImageSrc(item.sort)" alt="user-image" class="me-1" height="12"> <span
                            class="align-middle">{{ item.title }}</span>
                        </a>

                    </div>
                </li>


                <li class="dropdown d-inline-block d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                       href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-search noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                        <form class="p-3">
                            <input type="text" class="form-control" placeholder="Search ..."
                                   aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                <li class="dropdown d-none d-lg-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light text-danger">
                        <i class="fe-volume-x noti-icon"></i>
                    </a>
                </li>

                <li class="dropdown d-none d-lg-inline-block">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light data-toggle-fullscreen"
                       data-toggle="fullscreen">
                        <i class="fe-maximize noti-icon"></i>
                    </a>
                </li>

                <Notification count="15"></Notification>
                <Notification count="25" icon="fe-user-plus"></Notification>
                <Notification count="13" icon="fe-image"></Notification>
                <Notification count="45" icon="fe-plus-circle"></Notification>
                <Notification count="5" icon="fe-minus-circle"></Notification>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                       href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="pro-user-name ms-1">
                        {{ userData.name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-lock"></i>
                            <span>Lock Screen</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a @click="logout" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                        <i class="fe-settings noti-icon"></i>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <router-link :to="{name: 'home'}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="/assets/images/logo-sm.png" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                    <span class="logo-lg">
                    <img src="/assets/images/logo-dark.png" alt="" height="20">
                        <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
                </router-link>

                <router-link :to="{name: 'home'}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="/assets/images/logo-sm.png" alt="" height="22">
                </span>
                    <span class="logo-lg">
                    <img src="/assets/images/logo-light.png" alt="" height="20">
                </span>
                </router-link>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="d-none d-xl-block">
                    <a class="nav-link waves-effect waves-light" href="#">
                        <i class="mdi mdi-message-minus-outline"></i>
                        {{ $t(1644) }}
                        <span class="text-danger">(15)</span>
                    </a>
                </li>
                <li class="d-none d-xl-block">
                    <a class="nav-link waves-effect waves-light" href="#">
                        <i class="mdi mdi-phone-in-talk"></i>
                        {{ $t(1645) }}
                        <span class="text-danger">(15)</span>
                    </a>
                </li>

                <li class="dropdown limitList topbar-dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" @click="getSiteLimits"
                       role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-chart-bar"></i>
                        {{ $t(82) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg" v-if="siteLimits">


                        <div class="noti-scroll" data-simplebar>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item limitItem">
                                <div class="limitIcon">
                                    <i class="mdi mdi-soccer limitSport"></i></div>
                                <p class="limitDetails">{{ $t(1646) }}</p>
                                <p class="text-muted mb-0 user-msg">
                                    <b class="limitSport">{{ siteLimitsData.sport }} {{ siteLimitsData.currency }}</b>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item limitItem">
                                <div class="limitIcon">
                                    <i class="mdi mdi-cards-playing-outline limitCasino"></i></div>
                                <p class="limitDetails">{{ $t(414) }}</p>
                                <p class="text-muted mb-0 user-msg">
                                    <b class="limitCasino">{{ siteLimitsData.casino }} {{ siteLimitsData.currency }}</b>
                                </p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item limitItem">
                                <div class="limitIcon">
                                    <i class="mdi mdi-slot-machine limitSlot"></i></div>
                                <p class="limitDetails">{{ $t(406) }}</p>
                                <p class="text-muted mb-0 user-msg">
                                    <b class="limitSlot">{{ siteLimitsData.slot }} {{ siteLimitsData.currency }}</b>
                                </p>
                            </a>

                        </div>
                        <div class="limitButtonDiv">
                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                {{ $t(1649) | uppercase }}
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->
</template>
<script>
import Notification from "../../components/layout/topbar/Notification";
import globalConfig from "../../core/globalConfig";
import site from "../../core/sites/useSite";
import jwt from "../../auth/useJwt";
import jwtDefaultConfig from "../../auth/jwtDefaultConfig";
import {chanceMessage} from "../../i18n";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Topbar",
    components: {Notification},
    data() {
        return {
            userData: '',
            activeSite: '',
            sites: [],
            activeLangDefault: {},
            searchCustomerText: '',
            systemLanguages: [
                {
                    sort: 'tr',
                    title: 'Türkçe',
                },
                {
                    sort: 'en',
                    title: 'İngilizce',
                },
            ]
        }
    },
    computed: {
        ...mapGetters({
            siteLimitsData: 'Sites/siteLimits',
            customerInfo: 'Sites/getterCustomerInfo'
        })
    },
    methods: {
        ...mapActions({
            siteLimits : 'Sites/getSiteLimits',
            setGetCustomerInfo : 'Sites/getCustomerInfo'
        }),
        getCustomerInfo(){
            if (this.searchCustomerText.length > 2){
                this.setGetCustomerInfo(this.searchCustomerText).then(response => {
                })
            }
        },
        getSiteLimits() {
            this.siteLimits()
        },
        setLanguageImageSrc(lang) {
            return '/assets/images/flags/' + lang + '.png'
        },
        logout() {
            jwt.logout().then(() => {
                const storageLang = localStorage.getItem('active_lang')
                localStorage.clear()
                localStorage.setItem('active_lang', storageLang)
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Logout'
                });
                this.$router.push({name: 'login'})
            })
        },
        setSites() {
            let sites = localStorage.getItem(globalConfig.storageMySitesKeyName)
            if (sites !== null) {
                sites = JSON.parse(sites)
                if (sites.list) {
                    this.activeSite = site.getActiveSite()
                    this.sites = sites.list
                }
            }
        },
        chanceLang(lang) {
            localStorage.setItem('active_lang', lang)
            this.$store.commit('Settings/SET_ACTIVE_LANG', lang)
            this.$i18n.locale = lang;
            this.setDefaultLanguage()
            chanceMessage()
        },
        chanceSites(event) {
            site.setActiveSite(event.target.value)
            this.activeSite = event.target.value
        },
        setDefaultLanguage() {
            const storageLang = localStorage.getItem('active_lang')
            this.systemLanguages.forEach(item => {
                if (item.sort == storageLang) {
                    this.activeLangDefault = item
                }
            })
        },
    },
    watch: {
        activeSite: function () {
            this.$store.commit('Sites/SET_ACTIVE_SITES', this.activeSite)
        }
    },
    created() {
        this.activeSite = site.getActiveSite()
        this.userData = JSON.parse(localStorage.getItem(jwtDefaultConfig.userData))
        this.setSites()
        // this.getCustomerInfo()
        /**
         * active Lang set local variable
         */
        this.setDefaultLanguage()

        // this.siteLimits()
    },


}
</script>

<style scoped>
#siteSelector {
    color: #969696 !important;
}
</style>
