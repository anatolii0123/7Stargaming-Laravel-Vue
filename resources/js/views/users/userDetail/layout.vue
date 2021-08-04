<template>
    <div>
        <UserNav></UserNav>
        <transition  name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
import UserNav from "./userNav";
export default {
    name: "layout",
    components: {UserNav}
}
</script>

<style scoped>

</style>
