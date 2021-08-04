<template>
    <li class="nav-item">
        <router-link :to="to" :class="cssClass">
            <i :class="iconAdd"></i> <slot></slot>
        </router-link>
    </li>
</template>

<script>
export default {
    name: "navItem",
    props: ['to', 'path', 'icon','classSelector'],
    computed: {
        cssClass() {
            const cssClass = 'nav-link dropdown-toggle arrow-none'
            if (this.classSelector){
                return cssClass + ' ' + this.classSelector
            }
            return cssClass
        },
        iconAdd(){
            const icon = 'fe-airplay me-1'
            if (this.icon){
                return this.icon + ' me-1'
            }
            return icon
        }
    }
}
</script>

<style scoped>

</style>
