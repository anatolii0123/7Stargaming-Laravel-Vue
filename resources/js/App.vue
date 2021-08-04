<template>
    <component :is="layout">
        <router-view :key="reloadPage"/>
        <notifications group="foo" position="bottom left" />
    </component>
</template>

<script>

//Layouts
import {mapActions, mapGetters} from "vuex";
import axios from '@axios'

const LayoutApp = () => import('@/layout/AppLayout')
const LayoutFull = () => import('@/layout/FullLayout')

import navbarHorizontal from "./core/navbar/navbar";
import jwt from "./auth/useJwt";

export default {
    data() {
        return {
            reloadPage: 1
        }
    },
    components:{
        LayoutApp,
        LayoutFull
    },
    computed:{
        ...mapGetters({
            activeSite : 'Sites/activeSite',
            activeLang : 'Settings/activeLang',
        }),

        layout(){
            if (this.$route.meta.layout === 'full') return 'layout-full'
            return 'layout-app'
        }
    },
    methods:{
        setNavbar(){
            const nav = new navbarHorizontal(axios)
            nav.getNaw().then(() => {
                this.navbar = nav.menuList()
                this.$store.commit('Settings/SET_NAVBAR_CHANCE',Math.random())
            })
        },
    },
    watch: {
        activeSite: function (){
            this.reloadPage = this.activeSite
            this.setNavbar()
        },
        activeLang: function (){
            axios.interceptors.request.use(
                config => {
                    const activeLang = this.activeLang

                    if (activeLang){
                        config.headers.ActiveLang = activeLang
                    }
                    return config
                },
                error => Promise.reject(error),
            )
            this.reloadPage = this.activeLang
            this.setNavbar()
        }
    },
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
