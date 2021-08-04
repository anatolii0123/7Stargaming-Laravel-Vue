<template>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid userMax">


            <div class="row userListing">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion custom-accordion" id="custom-accordion-one">
                                <div class="card mb-0">
                                    <div class="card-header userFilter" id="headingNine">
                                        <h5 class="m-0 position-relative">
                                            <a class="custom-accordion-title text-reset d-block" data-bs-toggle="collapse" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                FİLTRE <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="row inputGroupFilter">
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Kullanıcı adına göre ara">
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Telefon Numarası">
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="E-Posta Adresi">
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Tc Kimlik ile Arama">
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="IP Adresi ile arama">
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Kayıt Tarihi ile arama">
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <select class="form-select">
                                                <option selected="">Affilate Seçiniz</option>
                                                <option value="1">Sıra 1</option>
                                                <option value="2">Sıra 2</option>
                                                <option value="3">Sıra 3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv">
                                            <select class="form-select">
                                                <option selected="">Grup Seçiniz</option>
                                                <option value="1">Sıra 1</option>
                                                <option value="2">Sıra 2</option>
                                                <option value="3">Sıra 3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 userFilterInput userFilterDiv userButton">
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                SONUÇLAR
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                                SIRALA
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 userListTitle">
                                <div class="col-md-10 userTitle">
                                    <h5>KULLANICI LİSTESİ</h5>
                                </div>
                                <div class="col-md-2 userSorting">
                                    <select class="form-select">
                                        <option selected="">SIRALAMA</option>
                                        <option value="1">Sıra 1</option>
                                        <option value="2">Sıra 2</option>
                                        <option value="3">Sıra 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <b-table :items="users.list.data"></b-table>
                            </div> <!-- end .table-responsive-->
                            <div class="col-md-12 navUserList">
                               <b-pagination
                                    :total-rows="users.list.total"
                                    align="center"
                                ></b-pagination>
                            </div>
                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col -->
            </div>


        </div> <!-- container -->

    </div> <!-- content -->
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "listBootstrap",
    computed:{
        ...mapGetters({
            users:  'Users/getterUserData'
        })
    },
    methods:{
        ...mapActions({
            getUsers: 'Users/getUserData'
        })
    },
    created() {
        this.getUsers()
    }
}
</script>

<style scoped>

</style>
