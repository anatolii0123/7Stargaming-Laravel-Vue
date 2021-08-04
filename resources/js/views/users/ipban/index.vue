<template>
    <content-page>
        <content-title title="Kullanıcılar">
            <div class="row">

                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.ip_address" type="text" class="form-control" placeholder="IP Address">
                </div>

                <div class="col-md-3 userFilterInput userFilterDiv">
                    <button type="button" class="btn btn-success waves-effect waves-light" @click="formFilterSumbit">
                        <i class="fa fa-search"></i> Search
                    </button>
                    
                    <button type="button" class="btn btn-danger waves-effect waves-light" @click="formFilterReset">
                        <i class="fa fa-recycle"></i > Reset
                    </button>
                </div>
            </div>
        </content-title>
        <table-title title="Kulllanıcı Listesi" :loading="loading" :no-data="ipbans.total" @createNew="createNew" :enableNew="true" >
            <template v-slot:table>
                <b-table
                    :items="ipbans.data"
                    :fields="fields"
                    v-if="!loading && ipbans.total > 0"
                    @sort-changed="sortingChanged"
                    :sort-by="filter.sort_key"
                    :sort-desc="filter.sort_value"
                    striped
                    class="table-bordered"
                >
                    <template #cell(action)="data">
                        <button
                            type="button"
                            class="btn btn-xs btn-warning waves-effect waves-light"
                            @click="editRow(data.item.id)"
                            ><i class="fa fa-edit"></i> Edit
                        </button>
                        <button
                            type="button"
                            class="btn btn-xs btn-danger waves-effect waves-light"
                            @click="deleteRow(data.item.id)"
                            ><i class="fa fa-trash"></i> Delete
                        </button>
                    </template>
                </b-table>
            </template>
            <template v-slot:nav>
                <b-pagination
                    v-if="ipbans.total > 0"
                    v-model="currentPage"
                    :total-rows="ipbans.total"
                    :per-page="ipbans.per_page"
                    align="center"
                    class="mt-2">
                </b-pagination>
            </template>
        </table-title>
        <b-modal
            id="modal-prevent-closing"
            ref="my-modal"
            title="IP BAN"
            @hidden="resetModal"
            @ok="handleOk"
        >
            <form ref="form" @submit.stop.prevent="handleSubmit">
               
                <b-form-group
                label="IP Address"
                label-for="name-input"
                invalid-feedback="IP Address is required"
                :state="stateIpAddress"
                >
                    <b-form-input
                        id="name-input"
                        v-model="inputIpAddress"
                        :state="stateIpAddress"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                label="Description"
                label-for="description-input"
                class="mt-3"
                invalid-feedback="Description is required"
                :state="stateDescription"
                >
                    <b-form-input
                        id="description-input"
                        v-model="inputDescription"
                        :state="stateDescription"
                        required
                    ></b-form-input>
                </b-form-group>

            </form>
        </b-modal>
    </content-page>
</template>

<script>
import ContentPage from "../../../components/layout/page/contentPage";
import ContentTitle from "../../../components/layout/page/contentTitle";
import TableTitle from "../../../components/layout/page/tableTitle";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "list",
    components: {TableTitle, ContentTitle, ContentPage},
    data() {
        return {
            loading: true,
            currentPage: 1,
            //the type of modal "new" or "edit"
            modalType:"",
            // current ip ban id when a user edit a row
            currentIpbanId:0,
            // ip address of modal
            inputIpAddress:"",
            // state of ip address of modal
            stateIpAddress:null,
            // description of modal
            inputDescription:"",
            // state of description of modal
            stateDescription:null,
            //Modal Input
            filter: {
                ip_address: null,
                page: 1,
                sort_key: null,
                sort_value: null
            },
            fields: [
                {
                    key: 'id',
                    sortable: true
                },
                {
                    key: 'ip_address',
                    sortable: true
                },
                {
                    label: 'Staff',
                    key: 'admin.username',
                    sortable: true
                },
                {
                    key: 'description',
                    sortable: true
                },
                {
                    key: 'create_date',
                    label: 'History',
                    sortable: true
                },
                {
                    key: 'action'
                }

            ]
        }
    },
    computed: {
        ...mapGetters({
            ipbans: 'Ipban/getterIpbans',
            ipbanDetail: 'Ipban/getterIpbanDetail',
        })
    },
    methods: {
        ...mapActions({
            getIpbans: 'Ipban/getIpbans',
            setUpdateIpban: 'Ipban/updateIpban',
            setCreateIpban: 'Ipban/createIpban',
            setDeleteIpban: 'Ipban/deleteIpban',
            setGetIpbanDetail: 'Ipban/getIpbanDetail'
        }),
        
        //Get Ip Ban datas from server
        getIpbansData() {
            this.loading = true
            this.getIpbans(this.filter).then(response => {
                this.loading = false
            })
        },
        //Create a new ip ban
        createNew() {
            this.resetModal();
            this.modalType = "new";
            this.$refs['my-modal'].show()
        },
        //edit a row
        editRow(ipban_id){
            this.setGetIpbanDetail(ipban_id).then(() => {
                this.modalType = "edit"
                this.currentIpbanId = this.ipbanDetail.id
                this.inputIpAddress = this.ipbanDetail.ip_address
                this.inputDescription = this.ipbanDetail.description
                this.$refs['my-modal'].show()
            });
        },

        //delete a row
        deleteRow(ipban_id){
            this.$bvModal.msgBoxConfirm('Please confirm that you want to delete it.', {
                title: 'Please Confirm',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'danger',
                okTitle: 'YES',
                cancelTitle: 'NO',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
                })
                .then(value => {
                    if(value){
                        this.setDeleteIpban(ipban_id).then(() => {
                            this.$notify({
                                group: 'foo',
                                type: 'success',
                                title: 'Success',
                                // text: 'Grup başarı ile silindi'
                                text: 'Success'
                            });
                            this.getIpbansData()
                        })
                    }
                })
                .catch(err => {
                    // An error occurred
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Error',
                        text: err
                    });
                })
        },

        //Sorting and Filtering
        sortingChanged(sort) {
            this.filter.sort_key = sort.sortBy
            this.filter.sort_value = sort.sortDesc
            this.getIpbansData()
        },

        //seach button event handler
        formFilterSumbit() {
            this.getIpbansData()
        },

        //reset button event handler
        formFilterReset() {
            this.filter = {
                ip_address: null,
                page: 1,
                sort_key: null,
                sort_value: null
            }
        },
        //new/edit modal validator
        checkFormValidity() {
            const valid = this.$refs.form.checkValidity()
            if(valid == false){

                if(this.inputIpAddress == ""){
                    this.stateIpAddress = false
                }else{
                    this.stateIpAddress = true
                }

                if(this.inputDescription == ""){
                    this.stateDescription = false
                }else{
                    this.stateDescription = true
                }
            }
            return valid
        },

        //new/edit modal clear
        resetModal(){
            this.modalType = "";
            this.inputIpAddress = "";
            this.stateIpAddress = null;
            this.inputDescription = "";
            this.stateDescription = null;

        },

        //event handler when a user click ok button in new/edit modal
        handleOk(bvModalEvt) {
            // Prevent modal from closing
            bvModalEvt.preventDefault()
            // Trigger submit handler
            this.handleSubmit()
        },

        //function when a user click ok button in new/edit modal
        handleSubmit() {
            // Exit when the form isn't valid
            if (!this.checkFormValidity()) {
                return
            }
            if(this.modalType == "new"){
                this.setCreateIpban({
                    ip_address : this.inputIpAddress,
                    description : this.inputDescription,
                    }).then(() => {
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Success',
                        // text: 'Grup başarı ile silindi'
                        text: 'Success'
                    });
                    this.getIpbansData()
                })
            }else if(this.modalType == "edit"){
                this.setUpdateIpban({
                        id: this.currentIpbanId,
                        data: {
                            ip_address : this.inputIpAddress,
                            description : this.inputDescription,
                         }
                    }).then(() => {
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Success',
                        // text: 'Grup başarı ile silindi'
                        text: 'Success'
                    });
                    this.getIpbansData()
                })
            }
            // Hide the modal manually
            this.$nextTick(() => {
                this.$bvModal.hide('modal-prevent-closing')
            })
        },
        
    },
    created() {
        this.getIpbansData()
    },
    watch: {
        currentPage: {
            handler: function () {
                this.filter.page = this.currentPage
                this.getIpbansData()
            }
        },
    },
}
</script>

<style scoped>

</style>
