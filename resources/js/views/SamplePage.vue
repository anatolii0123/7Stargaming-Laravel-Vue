<template>
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
        Burası boş bir sayfadır {{ this.$route.name }}
            <br>
            <router-link to="/test-page/155">
                Test Sayfasına git
            </router-link>

        </div>
    </div>
</template>

<script>
export default {
name: "SamplePage",
    data() {
        return {
            items: []
        }
    },
    created() {

    }
}
</script>

<style scoped>

</style>
