<template>
    <content-page>
        <content-title title="Kullanıcılar">
            <div class="row">
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.userId" min = 1 type="number" class="form-control" placeholder="Customer ID">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.uesrname" type="text" class="form-control" placeholder="Customer Name">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.start_date" type="date" class="form-control" id=""
                           placeholder="Start Date">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.end_date" type="date" class="form-control" id=""
                           placeholder="End Date">
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
        <table-title title="Kulllanıcı Listesi" :loading="loading" :no-data="customerNotes.total" @createNew="createNew" :enableNew="true" >
            <template v-slot:table>
                <b-table
                    :items="customerNotes.data"
                    :fields="fields"
                    v-if="!loading && customerNotes.total > 0"
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
                    v-if="customerNotes.total > 0"
                    v-model="currentPage"
                    :total-rows="customerNotes.total"
                    :per-page="customerNotes.per_page"
                    align="center"
                    class="mt-2">
                </b-pagination>
            </template>
        </table-title>
        <b-modal
            id="modal-prevent-closing"
            ref="my-modal"
            title="Customer Note"
            @hidden="resetModal"
            @ok="handleOk"
        >
            <form ref="form" @submit.stop.prevent="handleSubmit">
               
                <b-form-group
                v-if="modal.type == 'new'"
                label="Customer ID"
                label-for="id-input"
                invalid-feedback="Customer ID is required"
                :state="modalState.customer_id"
                >
                    <b-form-input
                        id="id-input"
                        v-model="modal.customer_id"
                        :state="modalState.customer_id"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                label="Note"
                label-for="note-input"
                class="mt-3"
                invalid-feedback="Note is required"
                :state="modalState.message"
                >
                    <b-form-input
                        id="note-input"
                        v-model="modal.message"
                        :state="modalState.message"
                        required
                    ></b-form-input>
                </b-form-group>

            </form>
        </b-modal>
    </content-page>
</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import ContentTitle from "../../components/layout/page/contentTitle";
import TableTitle from "../../components/layout/page/tableTitle";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "customerNotes",
    components: {TableTitle, ContentTitle, ContentPage},
    data() {
        return {
            loading: true,
            currentPage: 1,
            //Modal Input
            modal:{
                //the type of modal "new" or "edit"
                type:null,
                // current row id when a user edit a row
                id:null,
                customer_id:null,
                message:null,
            },
            modalState:{
                customer_id:null,
                message:null,
            },
            filter: {
                userId: null,
                username: null,
                start_date: null,
                end_date: null,
                page: 1,
                sort_key: null,
                sort_value: null
            },
            fields: [
                {
                    label: 'Customer ID',
                    key: 'player.id',
                    sortable: true
                },
                {
                    label: 'Customer Name',
                    key: 'player.username',
                    sortable: true
                },
                {
                    label: 'Note',
                    key: 'message',
                    sortable: true
                },                
                {
                    label: 'Staff',
                    key: 'admin.username',
                    sortable: true
                },
                {
                    label: 'Date',
                    key: 'create_date',
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
            customerNotes: 'CustomerNote/getterCustomerNotes',
            customerNoteDetail: 'CustomerNote/getterCustomerNoteDetail',
        })
    },
    methods: {
        ...mapActions({
            getCustomerNotes: 'CustomerNote/getCustomerNotes',
            setUpdateCustomerNote: 'CustomerNote/updateCustomerNote',
            setCreateCustomerNote: 'CustomerNote/createCustomerNote',
            setDeleteCustomerNote: 'CustomerNote/deleteCustomerNote',
            setGetCustomerNoteDetail: 'CustomerNote/getCustomerNoteDetail'
        }),
        
        //Get Ip Ban datas from server
        getCustomerNotesData() {
            this.loading = true
            this.getCustomerNotes(this.filter).then(response => {
                this.loading = false
            })
        },
        //Create a new ip ban
        createNew() {
            this.resetModal();
            this.modal.type = "new";
            this.$refs['my-modal'].show()
        },
        //edit a row
        editRow(row_id){
            this.setGetCustomerNoteDetail(row_id).then(() => {
                this.modal.type = "edit"
                this.modal.id = this.customerNoteDetail.id
                this.modal.message = this.customerNoteDetail.message
                this.$refs['my-modal'].show()
            });
        },

        //delete a row
        deleteRow(row_id){
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
                        this.setDeleteCustomerNote(row_id).then(() => {
                            this.$notify({
                                group: 'foo',
                                type: 'success',
                                title: 'Success',
                                // text: 'Grup başarı ile silindi'
                                text: 'Success'
                            });
                            this.getCustomerNotesData()
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
            this.getCustomerNotesData()
        },

        //seach button event handler
        formFilterSumbit() {
            this.getCustomerNotesData()
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
                if(this.modal.type == "new")
                {
                    if(this.modal.customer_id == ""){
                        this.modalState.customer_id = false
                    }else{
                        this.modalState.customer_id = true
                    }
                }

                if(this.modal.message == ""){
                    this.modalState.message = false
                }else{
                    this.modalState.message = true
                }
            }
            return valid
        },

        //new/edit modal clear
        resetModal(){
            this.modal.type = "";
            this.modal.customer_id = "";
            this.modalState.customer_id = null;
            this.modal.message = "";
            this.modalState.message = null;

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
            if(this.modal.type == "new"){
                this.setCreateCustomerNote({
                    customer_id : this.modal.customer_id,
                    message : this.modal.message,
                    }).then(() => {
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Success',
                        // text: 'Grup başarı ile silindi'
                        text: 'Success'
                    });
                    this.getCustomerNotesData()
                })
            }else if(this.modal.type == "edit"){
                this.setUpdateCustomerNote({
                        id: this.modal.id,
                        data: {
                            message : this.modal.message,
                         }
                    }).then(() => {
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Success',
                        // text: 'Grup başarı ile silindi'
                        text: 'Success'
                    });
                    this.getCustomerNotesData()
                })
            }
            // Hide the modal manually
            this.$nextTick(() => {
                this.$bvModal.hide('modal-prevent-closing')
            })
        },
        
    },
    created() {
        this.getCustomerNotesData()
    },
    watch: {
        currentPage: {
            handler: function () {
                this.filter.page = this.currentPage
                this.getCustomerNotesData()
            }
        },
    },
}
</script>

<style scoped>

</style>
