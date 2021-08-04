<template>
    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <dynamic-vue-component :content="navCreatorOne()"></dynamic-vue-component>
                </div> <!-- end .collapsed-->
                <router-link :to="{name: 'betting'}" class="btn btn-success waves-effect waves-light">
                    <i class="fas fa-check"></i>
                    <b>Bahis Yap</b>
                </router-link>
            </nav>
        </div> <!-- end container-fluid -->
    </div> <!-- end topnav-->
</template>

<script>
import NavItem from "../../components/layout/navbarHorizontal/NavItem";
import NavItemDropdown from "../../components/layout/navbarHorizontal/NavItemDropdown";

import navbarHorizontal from "../../core/navbar/navbar";
import Vue from "vue";
import {mapGetters} from "vuex";

export default {
    name: "Horizontal",
    data() {
        return {
            navbar: {}
        }
    },
    components: {
        DynamicVueComponent: {
            props: {
                content: {
                    type: String,
                    required: true
                }
            },
            render(h) {
                return h(Vue.compile(this.content))
            }
        },
        NavItemDropdown, NavItem },
    computed:{
        ...mapGetters({
            navbarChance : 'Settings/navbarChance'
        })
    },
    methods:{
        navCreatorOne() {
            var i= 0 ,childOne = 0 ,childTwo = 0,htmlNav = '' , nav = '<ul class="navbar-nav">'
            nav += '<li class="nav-item">'
            nav += '<router-link to="/" class="nav-link dropdown-toggle arrow-none" exact>'
            nav += '<i class="fe-airplay me-1"></i>'
            nav += 'Anasayfa'
            nav += '</router-link>'
            nav += '</li>'
            const navItems = this.navbar

            for (i; i < navItems.length ; i++){

                /** tekli menü */
                if (!navItems[i].children){
                    if (!navItems[i].meta.menu && navItems[i].meta.menu !== false){
                        nav += '<li class="nav-item">'
                        nav += '<router-link to="/'+navItems[i].path+'" class="nav-link dropdown-toggle arrow-none">'
                        nav += '<i class="'+ navItems[i].meta.icon +' me-1"></i>'
                        nav += navItems[i].title
                        nav += '</router-link>'
                        nav += '</li>'
                    }
                }else{
                    htmlNav = ''
                    htmlNav += ' <li class="nav-item dropdown">\n' +
                        '        <a class="nav-link dropdown-toggle arrow-none" :class="{ active: isNavActive(\''+navItems[i].path+'\')}" ' +
                        'href="#" id="topnav-apps" role="button"\n' +
                        '           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                        '            <i class="fe-grid me-1"></i>\n' +
                        navItems[i].title +
                        '            <div class="arrow-down"></div>\n' +
                        '        </a>' +
                        '<div class="dropdown-menu" aria-labelledby="topnav-dashboard">'

                    //console.log(navItems[i].children.length)
                    for (childOne = 0; childOne < navItems[i].children.length; childOne++) {
                       // console.log(navItems[i].children)
                        if (navItems[i].children[childOne].children) {
                            htmlNav += '<div class="dropdown">\n' +
                                '    <a class="dropdown-item dropdown-toggle arrow-none" :class="{ active: isNavActive(\''+navItems[i].path+'\')}"  href="#" id="topnav-' + i + '"\n' +
                                '       role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                                '        <i class="fe-shopping-cart me-1"></i> '+navItems[i].children[childOne].title+' <div class="arrow-down"></div>\n' +
                                '    </a>\n' +
                                '    <div class="dropdown-menu" aria-labelledby="topnav-' + i + '">\n'

                                /** 2. sub menü */
                                for (childTwo; childTwo < navItems[i].children[childOne].children.length; childTwo++){
                                    if (!navItems[i].children[childOne].children[childTwo].meta.menu && navItems[i].children[childOne].children[childTwo].meta.menu !== false) {
                                        htmlNav += '<router-link to="/' + navItems[i].children[childOne].children[childTwo].path + '" class="dropdown-item">' +
                                            navItems[i].children[childOne].children[childTwo].title +
                                            '</router-link>\n'
                                    }
                                }
                                htmlNav += '</div>\n' +
                                '</div>'
                        } else {
                            if (!navItems[i].children[childOne].meta.menu && navItems[i].children[childOne].meta.menu !== false){
                                htmlNav = htmlNav + '<router-link to="/' + navItems[i].children[childOne].path + '" class="dropdown-item"> ' + navItems[i].children[childOne].title + ' </router-link>'
                            }
                        }

                    }

                    nav += htmlNav + '</div></li>'
                }
                childOne = 0
                childTwo = 0
            }
            nav += '</ul>'
            return nav
        },
        setNavbar() {
            const nav = new navbarHorizontal('')
            this.navbar = nav.menuList()
        }
    },
    created() {
        this.setNavbar()
    },
    watch:{
        navbarChance: function (){
            this.setNavbar()
        }
    }
}
</script>

<style scoped>

</style>
