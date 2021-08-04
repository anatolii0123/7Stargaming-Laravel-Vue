<template>
    <div class="userGroupDetails">
        <div class="row alert-no-data">
            <div class="alert alert-dark bg-dark text-light border-0 mb-0 alertUserGroup" role="alert">
                <i class="mdi mdi-information"></i>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "noData"
}
</script>

<style scoped>
.alert-no-data {
    padding-left: 15px;
    padding-right: 15px;
}
</style>
