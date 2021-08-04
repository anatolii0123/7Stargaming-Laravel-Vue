<template>
    <div>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <router-link :to="{name: 'login'}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="/assets/images/logo-dark.png" alt="" height="22">
                                            </span>
                                        </router-link>

                                        <router-link :to="{name: 'login'}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="/assets/images/logo-light.png" alt="" height="22">
                                            </span>
                                        </router-link>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access back office..</p>
                                </div>

                                <form @submit.prevent="login">

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input v-model="user.email" class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" v-model="user.password" id="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" attr-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit" :disabled="loginButton"> Log In </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign in with</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <router-link :to="{name: 'forgotPassword'}" class="text-white-50 ml-1">Forgot your password?</router-link></p>
                                <p class="text-white-50">Don't have an account? <router-link :to="{name: 'register'}" class="text-white ml-1"><b>Sign Up</b></router-link></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt text-white-50">
            2016 - {{ new Date().getFullYear() }} &copy; Betting Software by <a href="https://www.betmodule.com" class="text-white-50">BetModule</a>
        </footer>
    </div>
</template>

<script>
import jwt from "@jwt/useJwt";
import navbarHorizontal from "../core/navbar/navbar";
import sites from '@core/sites/useSite'
import axios from "@axios";

export default {
    name: "Login",
    data() {
        return {
            loginButton: false,
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods:{
        test(){
            alert("test")
        },
        login(){
            this.loginButton = true
            jwt.login(this.user).then((response) => {
                jwt.setToken(response.data.access_token)
                this.$store.commit('Auth/SAVE_TOKEN_DATA', response.data)

                jwt.getUserData().then((resp) => {
                    jwt.setUserData(resp.data)
                    sites.getSites().then(() => {
                        sites.setAxiosHeaderAddActiveSite()

                        /**
                         * menüyü getir
                         */
                        const navbarH = new navbarHorizontal(axios)
                        navbarH.getNaw().then(() => {
                            this.$router.replace({name:"home"});
                            this.$notify({
                                group: 'foo',
                                type: 'success',
                                title: 'Success',
                                text: 'Welcome Ben Scott!'
                            });
                        })

                    })

                })
            }).catch((error) => {
                this.loginButton = false
            })
        }
    }
}
</script>

<style scoped>

</style>
