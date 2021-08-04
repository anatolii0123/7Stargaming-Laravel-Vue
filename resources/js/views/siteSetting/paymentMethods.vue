<template>
    <content-page>
        <div class="row">
            <div class="col-md-3">
                <card-content title="YÖNTEMLER">
                    <template v-slot:content>
                        <div class="row casinoCardDetail">
                            <button type="button" class="list-group-item list-group-item-action"
                                    :class="{active: method_type === 1}" @click="method_type = 1">Yatırım
                            </button>
                            <button type="button" class="list-group-item list-group-item-action"
                                    :class="{active: method_type === 2}" @click="method_type = 2">Çekim
                            </button>
                        </div>
                    </template>
                </card-content>
            </div>
            <div class="col-md-9">
                <card-content title="ÖDEME YÖNTEMLERİ">
                    <template v-slot:buttons>
                        <button type="button" class="btn btn-success btn-sm waves-effect waves-light"
                                v-b-modal.create-payment>YENİ OLUŞTUR
                        </button>
                    </template>
                    <template v-slot:content>
                        <div class="table-responsive"
                             v-if="!loading">
                            <b-table
                                :items="dataPaymentMethods.list"
                                :fields="fields"
                                class="table table-bordered mb-0"
                                responsive
                                v-if="Object.keys(dataPaymentMethods).length > 0"
                            >
                                <template #cell(name)="data">
                                    {{ data.item.group.name }}
                                </template>
                                <template #cell(min)="data">
                                    <span v-if="method_type == 1">
                                        {{ data.item.min_deposit }}
                                    </span>
                                    <span v-if="method_type == 2">
                                        {{ data.item.min_withdraw }}
                                    </span>
                                </template>
                                <template #cell(max)="data">
                                    <span v-if="method_type == 1">
                                        {{ data.item.max_deposit }}
                                    </span>
                                    <span v-if="method_type == 2">
                                        {{ data.item.max_withdraw }}
                                    </span>
                                </template>
                                <template #cell(status)="data">
                                    <button class="btn btn-danger btn-sm" v-if="data.item.status == 0" @click="updatePaymentStatus(data, 1, $event)">Pasif</button>
                                    <button class="btn btn-success btn-sm" v-if="data.item.status == 1" @click="updatePaymentStatus(data, 0, $event)">Aktif</button>
                                </template>
                                <template #cell(actions)="data">
                                    <b-button variant="warning" size="sm" class="text-white" @click="updatePaymentModalShow(data)">Düzenle</b-button>
                                </template>
                            </b-table>
                            <no-data v-if="Object.keys(dataPaymentMethods.list).length <= 0">
                                Bu site için ödeme yöntemi bulunamadı.
                            </no-data>
                        </div>
                        <loading-spinner v-else></loading-spinner>


                    </template>
                </card-content>
            </div>
        </div>
        <create-payment-method-modal :update-payment="updatePayment"></create-payment-method-modal>
    </content-page>
</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import CardContent from "../../components/layout/userDetail/cardContent";
import {mapActions, mapGetters} from "vuex";
import LoadingSpinner from "../../components/widgets/loadingSpinner";
import CreatePaymentMethodModal from "../../components/widgets/settings/createPaymentMethodModal";
import NoData from "../../components/widgets/alert/noData";

export default {
    name: "paymentMethods",
    data() {
        return {
            loading: true,
            method_type: 1,
            fields: [
                {
                    key: 'id',
                    label: 'ID'
                },
                {
                    key: 'name',
                    label: 'Name',
                },
                {
                    key: 'min',
                    label: 'Min'
                },
                {
                    key: 'max',
                    label: 'Max'
                },
                {
                    key: 'priority',
                    label: 'Sıra'
                },
                {
                    key: 'status',
                    label: 'Status'
                },
                {
                    key: 'actions',
                    label: ''
                }
            ]
        }
    },
    components: {NoData, CreatePaymentMethodModal, LoadingSpinner, CardContent, ContentPage},
    computed: {
        ...mapGetters({
            dataPaymentMethods: 'Settings/getterPaymentMethods'
        })
    },
    methods: {
        ...mapActions({
            paymentMethods: 'Settings/getPaymentMethods',
            setPaymentMethodStatus: 'Settings/setPaymentMethodStatus'
        }),
        getPaymentMethods() {
            this.updatePayment = null
            this.loading = true
            this.paymentMethods({method_type: this.method_type}).then(() => {
                this.loading = false
            }).catch(() => {
                this.loading = false
                this.$notify({
                    group: 'foo',
                    type: 'danger',
                    title: 'error',
                    text: 'Error'
                });
            })
        },
        updatePaymentStatus(data, status, event){
            event.preventDefault()
            event.target.disabled = true
            this.setPaymentMethodStatus({
                id: data.item.id,
                status: status
            }).then(() => {
                this.dataPaymentMethods.list[data.index].status = status
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                })
                event.target.disabled = false
            }).catch(() => {
                this.$notify({
                    group: 'foo',
                    type: 'danger',
                    title: 'error',
                    text: 'Error'
                });
            })
        },
        updatePaymentModalShow(data){
            this.$store.commit('Settings/SET_UPDATE_PAYMENT_METHOD',data.item)
            this.$bvModal.show('create-payment')
        }
    },
    watch: {
        method_type: {
            handler: function () {
                this.getPaymentMethods()
            }
        }
    },
    created() {
        this.getPaymentMethods()
    }

}
</script>

<style scoped>

</style>
