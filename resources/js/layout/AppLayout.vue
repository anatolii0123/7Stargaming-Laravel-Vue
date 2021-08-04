<template>
    <div>
        <div v-if="!loading">
            <!-- Begin page -->
            <div id="wrapper">

                <Menu></Menu>

                <!-- ============================================================== -->
                <!-- Start Page Content here -->
                <!-- ============================================================== -->

                <div class="content-page">
                    <slot/>
                    <Footer></Footer>

                </div>

                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->

            </div>
            <!-- END wrapper -->
            <RightSidebar></RightSidebar>
        </div>
        <div v-else>
            Bekle!
        </div>
    </div>
</template>

<script>
import Menu from "./partials/Menu";
import Footer from "./partials/Footer";
import RightSidebar from "./partials/RightSidebar";
import jwt from "../auth/useJwt";
import {mapGetters} from "vuex";

/**
 * navbar
 */


export default {
    name: "Layout",
    data() {
        return {
            loading: false,
        }
    },
    components: {RightSidebar, Footer, Menu},
    computed: {
        ...mapGetters({
            authData: 'Auth/getterAuthData'
        }),
    },
    methods: {
        setRouter() {

        }
    },
    created() {

    },
    mounted() {

        /**
         * token süresinin dolmasına 5sn kala refres token al
         * @type {number}
         */

        let timeUntilRefresh = 2000

        setInterval(() => {
            if ((this.authData.tokenExp * 1000) - Date.now() < 5000) {
                jwt.refreshToken().then(data => {
                    this.$store.commit('Auth/SAVE_TOKEN_DATA', data)
                })
            }
        }, timeUntilRefresh)

    }

}
</script>

<style scoped>

</style>
