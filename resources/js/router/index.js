import Vue from 'vue'
import VueRouter from 'vue-router'
//user functions
import {isUserLoggedIn} from "@jwt/functions";


import {userManagement} from './users.router'
import {invoices} from "./invoices.router";
import {finance} from "./finance.router";
import {coupons} from "./coupons.router";
import {riskManagement} from "./riskManagement.router";
import {webManagement} from "./webManagement";
import {sites} from "./sites.router";
import {siteSetting} from "./siteSettings.router";
import {affiliates} from "./affiliates.router";
import {sportsBookManagement} from "./sportsBookManagement.router";
import {betting} from "./betting.router";
import store from "../store/store";
import jwtDefaultConfig from "../auth/jwtDefaultConfig";



Vue.use(VueRouter)

const routerAll =  [
    {
        name: 'login',
        path: '/login',
        meta: {
            layout: 'full'
        },
        component: () => import('@views/Login')
    },

    {
        name: 'register',
        path: '/register',
        meta: {
            layout: 'full'
        },
        component: () => import('@views/Register')
    },

    {
        name: 'forgotPassword',
        path: '/forgot-password',
        meta: {
            layout: 'full'
        },
        component: () => import('@views/ForgotPassword')
    },

    {
        name: 'home',
        path: '/',
        meta: {
            auth: true
        },
        component: () => import('@views/defaultHome')
    },
    {
        name: 'sample-page',
        path: '/sample-page',
        meta: {
            auth: true
        },
        component: () => import('@views/SamplePage')
    },

    {
        name: 'notFound',
        path: '/404',
        meta:{
            layout: "full"
        },
        component: () => import('@views/error404')
    },
    // all page revirate


]

routerAll.push.apply(routerAll, userManagement);
routerAll.push.apply(routerAll, invoices)
routerAll.push.apply(routerAll, finance)
routerAll.push.apply(routerAll, coupons)
routerAll.push.apply(routerAll, riskManagement)
routerAll.push.apply(routerAll, webManagement)
routerAll.push.apply(routerAll, sites)
routerAll.push.apply(routerAll, siteSetting)
routerAll.push.apply(routerAll, affiliates)
routerAll.push.apply(routerAll, sportsBookManagement)
routerAll.push.apply(routerAll, betting)


routerAll.push({
    path: '*',
    redirect: '/404',
})

const router = new VueRouter({
    mode: 'history',
    routes: routerAll,
    linkActiveClass: 'active'
})

router.beforeEach((to, from, next) => {

    // add or remove class from body tag
    if (
        to.fullPath === "/login" ||
        to.fullPath === "/404" ||
        to.fullPath === "/register" ||
        to.fullPath === "/forgot-password"
    ){
        $("body").addClass("authentication-bg");
        $("body").addClass("authentication-bg-pattern");
    }else{
        $("body").removeClass("authentication-bg");
        $("body").removeClass("authentication-bg-pattern");
    }
    // add or remove class from body tag

    const isLoggedIn = isUserLoggedIn()
    if (!isLoggedIn && to.meta.auth) {
        return next({name: 'login'})
    }
   // loadLanguageAsync().then(() => next())

    return next(next)
})


if (isUserLoggedIn()){
    store.commit('Auth/SAVE_TOKEN_DATA', {
        access_token: localStorage.getItem(jwtDefaultConfig.storageTokenKeyName)
    })
}
/*
if (isUserLoggedIn()) {

    // my sites

    // menü
    const navbarH = new navbarHorizontal(axios)
    navbarH.getNaw()
    // add routes
    const menu = navbarH.menuList()
    if (menu.length > 0){
        menu.forEach(firstMenu => {

            if (!firstMenu.children) {
                //1. menüyü ekle
                router.addRoute({
                    name: firstMenu.name,
                    component: () => import('@views/' + firstMenu.component),
                    path: '/' + firstMenu.path
                })
            } else {
                const secondMenu = firstMenu.children
                secondMenu.forEach(secondMenuItem => {
                    if (!secondMenuItem.children) {
                        //2. menüyü ekle
                        router.addRoute({
                            name: secondMenuItem.name,
                            component: () => import('@views/' + secondMenuItem.component),
                            path: '/' + secondMenuItem.path
                        })
                    }else{
                        const thirdMenu = secondMenuItem.children
                        thirdMenu.forEach(thirdMenuItem => {
                            if(!thirdMenuItem.children){
                                // 3. menüyü ekle
                                router.addRoute({
                                    name: thirdMenuItem.name,
                                    component: () => import('@views/' + thirdMenuItem.component),
                                    path: '/' + thirdMenuItem.path
                                })
                            }else{
                                //4. açılır menü router gelirse bu kısımdan devam edilecek.
                            }
                        })
                    }
                })
            }

        })
    }

    // add routes end
}

*/

export default router
