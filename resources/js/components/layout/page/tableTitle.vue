<template>
    <div class="card">
        <div class="card-body">
            <div class="col-md-12 userListTitle">
                <div class="col-md-10 userTitle">
                    <h5>{{ title }} <b v-if="noData">({{ noData }})</b></h5>
                </div>
                <slot name="titleActions"></slot>
                <div v-if="enableNew" class="col-md-8 userGroupSorting">
                    <button type="button" class="btn btn-success waves-effect waves-light" @click="sendMethod()">
                        <i class="fa fa-plus" style="font-size : 12px"></i> Create New
                    </button>
                </div>
            </div>

            <div class="table-responsive table-vue-bs" v-if="!loading">
                <slot name="table"></slot>
            </div> <!-- end .table-responsive-->

            <div class="col-md-12 navUserList" v-if="!loading">
                <slot name="nav"></slot>
            </div>

            <div class="col-md-12 text-center" v-if="loading">
                <div
                    class="spinner-border avatar-md text-primary m-2 text-center"
                    role="status"
                ></div>
            </div>

            <div class="row" v-if="!loading && !noData">
                <div class="col-md-12">
                    <div class="alert alert-primary m-2" role="alert">
                        Aradığınız kriterlere uygun kayıt bulunamamıştır !
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "tableTitle",
    props:['title', 'loading', 'noData', 'enableNew'],
    
    methods:{
        sendMethod(){
            this.$emit("createNew")
        }
    }
}
</script>

<style scoped>

</style>
