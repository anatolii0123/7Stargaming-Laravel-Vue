<template>
    <b-modal
        id="create-payment"
        :title="modalTitle()"
        size="lg"
        :ok-disabled="btnOkDisabled"
        @cancel="btnPaymentMethodCancel"
        @hidden="btnPaymentMethodCancel"
        @ok="handleSubmit"
        @show="modalShowPaymentForm"
    >
        <div class="block mb-3">
            <div v-if="createMethodType === null">
                <b-button class="mt-2 block" variant="outline-primary" block @click="getPaymentMethodGroupsAction(2)">
                    Otomatik Entegrasyon
                </b-button>
                <b-button class="mt-3" variant="outline-success" block @click="getPaymentMethodGroupsAction(1)">Manuel
                    Form
                </b-button>
            </div>
            <div v-if="modalType === 'insert' && createMethodType !== null">
                <b-button class="mt-3" variant="outline-secondary" block
                          @click="createMethodType = null, btnOkDisabled = true">İptal Et
                </b-button>
            </div>
            <hr>
        </div>
        <div class="block" v-if="!loading">
            <form @submit.stop.prevent="handleSubmit" v-if="createMethodType !== null" class="createPaymenMethod">
                <h4 v-if="createMethodType === 2">Otomatik Entegrasyon</h4>
                <h4 v-if="createMethodType === 1">Manuel Form</h4>
                <!-- Ödeme grubu -->
                <b-form-group
                    label="Ödeme Grubu"
                >
                    <b-select class="form-select" v-model="newMethod.group_id" required>
                        <b-form-select-option v-for="(option, index) in dataPaymentMethodGroups.list" :value="option.id"
                                              :key="index">
                            {{ option.name }} ({{ option.id }})
                        </b-form-select-option>
                    </b-select>
                </b-form-group>
                <!-- ödeme grubu end -->
                <!-- ödeme dili -->
                <b-form-group v-if="newMethod.group_id > 0"
                              label="Dil"
                              class="mt-1"
                >
                    <b-select class="form-select" v-model="newMethod.lang" required>
                        <b-form-select-option v-for="(option, index) in dataLanguages.list" :value="option.code"
                                              :key="index">
                            {{ option.name }}
                        </b-form-select-option>
                    </b-select>
                </b-form-group>
                <!-- ödeme dili end -->
                <!-- deposit and withdraw -->
                <div class="row" v-if="newMethod.lang">
                    <div class="col-md-6">
                        <b-form-group
                            label="Deposit"
                            class="mt-1"
                        >
                            <b-select class="form-select" v-model="newMethod.deposit" required>
                                <b-form-select-option value="">Seçiniz</b-form-select-option>
                                <b-form-select-option value="1">Aktif</b-form-select-option>
                                <b-form-select-option value="0">Pasif</b-form-select-option>
                            </b-select>
                        </b-form-group>
                    </div>
                    <div class="col-md-6">
                        <b-form-group
                            label="Withdraw"
                            class="mt-1"
                        >
                            <b-select class="form-select" v-model="newMethod.withdraw" required>
                                <b-form-select-option value="">Seçiniz</b-form-select-option>
                                <b-form-select-option value="1">Aktif</b-form-select-option>
                                <b-form-select-option value="0">Pasif</b-form-select-option>
                            </b-select>
                        </b-form-group>
                    </div>
                </div>
                <!-- deposit and withdraw end -->

                <!-- min/max deposit and min/max withdraw -->
                <div class="row mt-2" v-if="newMethod.deposit > 0 || newMethod.withdraw > 0">
                    <div class="col-md-6">
                        <div class="row" v-if="newMethod.deposit > 0">
                            <div class="col-md-6">
                                <b-form-group label="Min Deposit">
                                    <b-form-input type="number" v-model="newMethod.min_deposit" required>
                                    </b-form-input>
                                </b-form-group>
                            </div>
                            <div class="col-md-6">
                                <b-form-group label="Max Deposit">
                                    <b-form-input type="number" v-model="newMethod.max_deposit" required>
                                    </b-form-input>
                                </b-form-group>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row" v-if="newMethod.withdraw > 0">
                            <div class="col-md-6">
                                <b-form-group label="Min Withdraw">
                                    <b-form-input type="number" v-model="newMethod.min_withdraw" required>
                                    </b-form-input>
                                </b-form-group>
                            </div>
                            <div class="col-md-6">
                                <b-form-group label="Max Withdraw">
                                    <b-form-input type="number" v-model="newMethod.max_withdraw" required>
                                    </b-form-input>
                                </b-form-group>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- min/max deposit and min/max withdraw end -->
                <!-- blank -->
                <b-form-group
                    label="Blank"
                    v-if="newMethod.deposit > 0 || newMethod.withdraw > 0"
                >
                    <b-select class="form-select" v-model="newMethod.blank" required>
                        <b-form-select-option value="0">Pasif</b-form-select-option>
                        <b-form-select-option value="1">Aktif</b-form-select-option>
                    </b-select>
                </b-form-group>

                <!-- blank end -->

                <!-- priority -->
                <b-form-group
                    v-if="newMethod.deposit > 0 || newMethod.withdraw > 0"
                    label="Priority"
                    class="pt-2"
                >
                    <b-form-input type="number" v-model="newMethod.priority"></b-form-input>
                </b-form-group>
                <!-- priority end -->

                <!-- description -->
                <b-form-group
                    v-if="newMethod.deposit > 0 || newMethod.withdraw > 0"
                    label="Description"
                    class="pt-2"
                >
                    <b-form-input type="text" v-model="newMethod.description"></b-form-input>
                </b-form-group>
                <!-- description end -->

                <!-- image -->
                <b-form-group
                    v-if="newMethod.deposit > 0 || newMethod.withdraw > 0"
                    label="Image"
                    class="pt-2"
                >
                    <b-form-input type="text" v-model="newMethod.image"></b-form-input>
                </b-form-group>
                <!-- image end -->

                <!-- fee -->
                <b-form-group
                    v-if="newMethod.deposit > 0 || newMethod.withdraw > 0"
                    label="Fee"
                    class="pt-2"
                >
                    <b-form-input type="text" v-model="newMethod.fee"></b-form-input>
                </b-form-group>
                <!-- fee end-->

                <!-- time -->
                <b-form-group
                    v-if="newMethod.deposit > 0 || newMethod.withdraw > 0"
                    label="Time"
                    class="pt-2"
                >
                    <b-form-input type="text" v-model="newMethod.time"></b-form-input>
                </b-form-group>
                <!-- time end -->

                <!-- API ID -->
                <b-form-group
                    v-if="(newMethod.deposit > 0 || newMethod.withdraw > 0) && createMethodType == 2"
                    label="API ID"
                    class="pt-2"
                >
                    <b-form-input type="number" v-model="newMethod.api_id"></b-form-input>
                </b-form-group>
                <!-- API ID end -->

                <!-- API key -->
                <b-form-group
                    v-if="(newMethod.deposit > 0 || newMethod.withdraw > 0) && createMethodType == 2"
                    label="API Key"
                    class="pt-2"
                >
                    <b-form-input type="text" v-model="newMethod.api_key"></b-form-input>
                </b-form-group>
                <!-- API key end -->

                <!-- session ID -->
                <b-form-group
                    v-if="(newMethod.deposit > 0 || newMethod.withdraw > 0) && createMethodType == 2"
                    label="SESSION ID"
                    class="pt-2"
                >
                    <b-form-input type="text" v-model="newMethod.session_id"></b-form-input>
                </b-form-group>
                <!-- session ID end -->

                <!-- form -->
                <div class="block mt-1"
                     v-if="createMethodType === 1 && newMethod.deposit > 0 || newMethod.withdraw > 0">
                    <div class="row">
                        <div class="col-md-6">
                            <b-button block variant="warning" @click="$bvModal.show('add-input')">İnput Ekle</b-button>
                        </div>
                        <div class="col-md-6">
                            <b-button block variant="warning" @click="$bvModal.show('add-select')">Select Ekle
                            </b-button>
                        </div>
                        <div class="col-md-12 mt-1">
                            <hr>
                            <component
                                v-for="(formItem, index) in newMethod.form"
                                :key="index" :is="customFormTypeComponent(formItem.type)"
                                v-bind="customFormTypeComponentProps(formItem, index)"
                                @delete-form-item="onCustomFormItemDelete"
                                class="mt-1"
                            >
                            </component>
                            <hr>
                        </div>
                    </div>
                </div>
                <!-- form end -->
            </form>

        </div>
        <loading-spinner v-else></loading-spinner>
        <!-- custom form modals -->
        <add-form-input-modal @input="addForm"></add-form-input-modal>
        <add-form-select-modal @select="addForm"></add-form-select-modal>
        <edit-from-input-modal @inputEdit="editForm"></edit-from-input-modal>
        <edit-form-select-modal @selectEdit="editForm"></edit-form-select-modal>
        <!-- custom form modals end -->
    </b-modal>
</template>

<script>/**
 *  @param createMethodType (1 = manuel Form) / (2 = otomatik entegrasyon)
 */

import {mapActions, mapGetters} from "vuex";
import LoadingSpinner from "../loadingSpinner";
import AddFormInputModal from "./paymentMethod/addFormInputModal";
import viewInput from "./paymentMethod/viewInput";
import AddFormSelectModal from "./paymentMethod/addFormSelectModal";
import ViewSelect from "./paymentMethod/viewSelect";
import EditFromInputModal from "./paymentMethod/editFromInputModal";
import EditFormSelectModal from "./paymentMethod/editFormSelectModal";

export default {
    name: "createPaymentMethodModal",
    // props:['updatePayment'],
    components: {
        EditFormSelectModal,
        EditFromInputModal, ViewSelect, AddFormSelectModal, viewInput, AddFormInputModal, LoadingSpinner},
    data() {
        return {
            createMethodType: null,
            loading: false,
            btnOkDisabled: true,
            modalType: 'insert',
            newMethod: {
                form: [],
                lang: '',
                group_id: 0,
                priority: 0,
                description: '',
                deposit: 0,
                withdraw: 0,
                min_deposit: 0,
                min_withdraw: 0,
                max_deposit: 0,
                max_withdraw: 0,
                image: '',
                fee: '',
                time: '',
                session_id: '1',
                api_id: 0,
                api_key: '-',
                blank: 0
            },
        }
    },
    computed: {
        ...mapGetters({
            dataPaymentMethodGroups: 'Settings/getterPaymentMethodGroups',
            dataLanguages: 'Translates/getterLanguages',
            dataUpdatePayment: 'Settings/getterUpdatePaymentMethod'
        }),

    },
    methods: {
        ...mapActions({
            getPaymentMethodGroups: 'Settings/getPaymentMethodGroups',
            getLanguages: 'Translates/getLanguages',
            createPaymentMethod: 'Settings/createPaymentMethod',
            updatePaymentMethod: 'Settings/updatePaymentMethod',
            paymentMethods: 'Settings/getPaymentMethods',
        }),
        modalTitle(){
            if (this.modalType === 'update') return 'Ödeme Yöntemi Düzenle'
            return 'Yeni Ödeme Yöntemi Oluştur'
        },
        handleSubmit(event) {
            event.preventDefault()
            if (this.modalType === 'insert'){
                this.newMethod.form = JSON.stringify({forms: this.newMethod.form})
                this.createPaymentMethod(this.newMethod).then(() => {
                    this.refreshFormData()
                    this.paymentMethods().then(() => {
                        this.$bvModal.hide('create-payment')
                        this.$notify({
                            group: 'foo',
                            type: 'success',
                            title: 'Success',
                            text: 'Success'
                        })
                    })
                }).catch(error => {
                    error = Object.values(error)
                    error.forEach(item => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Error',
                            text: item[0]
                        });
                    })
                })
            }
            if (this.modalType === 'update'){
                this.newMethod.form = JSON.stringify({forms: this.newMethod.form})
                this.updatePaymentMethod({ id: this.newMethod.id, data: this.newMethod }).then(() => {
                    this.paymentMethods().then(() => {
                        this.refreshFormData()
                        this.$bvModal.hide('create-payment')
                        this.$notify({
                            group: 'foo',
                            type: 'success',
                            title: 'Success',
                            text: 'Success'
                        })
                    })
                }).catch(error => {
                    error = Object.values(error)
                    error.forEach(item => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Error',
                            text: item[0]
                        });
                    })
                })
            }

        },
        getPaymentMethodGroupsAction(type, formType = 'insert') {
            this.loading = true
            this.btnOkDisabled = true
            this.createMethodType = type
            if (formType === 'insert') {
                this.modalType = 'insert'
                this.refreshFormData()
            }
            if (!this.dataPaymentMethodGroups) {
                this.getPaymentMethodGroups().then(() => {
                    this.getLanguages().then(() => {
                        this.loading = false
                    })
                    // this.loading = false
                })
            } else {
                this.loading = false
            }
        },
        okDisabled() {
            if (
                this.newMethod.group_id !== 0 &&
                this.newMethod.lang !== '' &&
                (this.newMethod.deposit !== 0 || this.newMethod.withdraw !== 0)
            ) {
                if (this.newMethod.form !== '' || this.createMethodType == 2) {
                    this.btnOkDisabled = false
                }


            }
        },
        refreshFormData() {
            this.newMethod = {
                form: [],
                lang: '',
                group_id: 0,
                priority: 0,
                description: '',
                deposit: 0,
                withdraw: 0,
                min_deposit: 0,
                min_withdraw: 0,
                max_deposit: 0,
                max_withdraw: 0,
                image: '',
                fee: '',
                time: '',
                session_id: '1',
                api_id: 0,
                api_key: '-',
                blank: 0
            }
        },
        btnPaymentMethodCancel() {
            this.createMethodType = null
            this.refreshFormData()
            this.$store.commit('Settings/SET_UPDATE_PAYMENT_METHOD', null)
        },
        /**
         * manuel form
         */
        customFormTypeComponent(formType) {
            if (formType === 'input') return 'viewInput'
            if (formType === 'select') return 'ViewSelect'
        },
        onCustomFormItemDelete(index) {
            this.newMethod.form.splice(index, 1)
        },
        customFormTypeComponentProps(data, index) {
            return {
                item: data,
                index: index
            }
        },
        addForm(input) {
            this.newMethod.form.push(input)
        },
        editForm(val){
            this.newMethod.form[val.index] = val.item
            this.$store.commit('Settings/SET_PAYMENT_METHOD_CUSTOM_FORM_EDIT', {})
        },
        /**
         * modal show payment method
         */
        modalShowPaymentForm() {
            if (this.dataUpdatePayment !== null) {
                this.modalType = 'update'
                this.newMethod = this.dataUpdatePayment
                if (this.newMethod.form !== null) {
                    if (this.newMethod.api_id === '') this.newMethod.api_id = 0
                    if (this.newMethod.api_key === '') this.newMethod.api_key = 0
                    if (this.newMethod.session_id === '') this.newMethod.session_id = '-'
                    this.newMethod.form = this.newMethod.form.forms
                    this.getPaymentMethodGroupsAction(1, 'update')
                } else {
                    this.getPaymentMethodGroupsAction(2, 'update')
                }
            }else{
                this.modalType = 'insert'
            }
        }


    },
    watch: {
        newMethod: {
            handler: function () {
                this.okDisabled()
            },
            deep: true
        },
    }
}
</script>

<style scoped>
.btn-block {
    display: block;
    width: 100%;
}

.createPaymenMethod > legend {
    font-weight: bold !important;
}
</style>
