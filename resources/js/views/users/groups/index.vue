<template>

    <div class="content" >
        <!-- Start Content-->
        <div class="container-fluid userMax" v-if="!loading">
            <div class="row userListing">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <group-detail :dataG="activeGroup"></group-detail>
                            <div class="col-md-4">
                                <div class="userGroupLeftBody">
                                    <div class="col-md-12 userGroupListTitle">
                                        <div class="col-md-4 userGroupTitle">
                                            <h5>KULLANICI GRUPLARI</h5>
                                        </div>
                                        <div class="col-md-8 userGroupSorting">
                                            <button type="button" class="btn btn-success waves-effect waves-light"
                                            @click="activeGroup = null"
                                            >
                                                YENİ OLUŞTUR</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="userGroup tb10 uspT10" v-if="groups.length">
                                    <button type="button"
                                            class="list-group-item list-group-item-action"
                                            :class="{active: (activeGroup) &&group.id == activeGroup.id }"
                                            v-for="group in groups"
                                            @click="activeGroup = group"
                                    >
                                        <i :class="group.icon"></i>
                                        {{ group.name }}
                                    </button>
                                </div>
                                <div class="userGroup tb10 uspT10" v-else>
                                    <div class="col-md-12">
                                        <div class="alert alert-primary m-2" role="alert">
                                            Aradığınız kriterlere uygun kayıt bulunamamıştır !
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end .table-responsive-->

                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col -->
            </div>


        </div> <!-- container -->


        <div class="col-md-12 text-center" v-if="loading">
            <div
                class="spinner-border avatar-md text-primary m-2 text-center"
                role="status"
            ></div>
        </div>

    </div> <!-- content -->
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import GroupDetail from "./groupDetail";

export default {
    name: "userManagement",
    components: {GroupDetail},
    data() {
        return {
            loading: true,
            activeGroup: null
        }
    },
    computed:{
        ...mapGetters({
            groups: 'UserManagement/groups'
        }),
    },
    methods:{
        ...mapActions({
            setGroups: 'UserManagement/getGroups'
        }),
        getGroups() {
            this.loading = true
            this.setGroups().then(() => {
                this.activeGroup = this.groups[0]
                this.loading = false
            })
        },
    },
    created() {
        this.getGroups()

    },
    watch:{
        groups: function (){

        }
    }
}
</script>

<style scoped>

</style>
