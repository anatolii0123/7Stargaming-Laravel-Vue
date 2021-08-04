<template>
    <div>
        <Topbar></Topbar>
        <Horizontal></Horizontal>
    </div>
</template>

<script>
import Topbar from "./Topbar";
import Horizontal from "./Horizontal";
export default {
    name: "Menu",
    components: {Horizontal, Topbar}
}
</script>

<style scoped>

</style>
