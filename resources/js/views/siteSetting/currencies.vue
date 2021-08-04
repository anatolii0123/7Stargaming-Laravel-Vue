<template>
    <content-page>
        <div class="col-md-12">
            <card-content title="PARA BİRİMLERİ">
                <template v-slot:buttons>
                    <button type="button" class="btn btn-success btn-sm waves-effect waves-light"
                            @click="openCreateCurrencyModal($event)">YENİ OLUŞTUR
                    </button>
                </template>
                <template v-slot:content>
                    <div class="table-responsive" v-if="!loading">
                        <b-table
                            :items="dataCurrencies.list"
                            :fields="fields"
                            class="table table-bordered mb-0"
                            v-if="Object.keys(dataCurrencies.list).length > 0">
                            <template #cell(status)="data">
                                <button class="btn btn-danger btn-sm" v-if="data.item.status == 0"
                                        @click="updateCurrencyStatus(data, 1, $event)">Pasif
                                </button>
                                <button class="btn btn-success btn-sm" v-if="data.item.status == 1"
                                        @click="updateCurrencyStatus(data, 0, $event)">Aktif
                                </button>
                            </template>
                        </b-table>
                        <no-data v-if="Object.keys(dataCurrencies.list).length <= 0">
                            Bu site için para birimi bulunamadı.
                        </no-data>
                    </div>
                    <loading-spinner v-else></loading-spinner>
                </template>
            </card-content>
        </div>

        <b-modal id="create-currency" title="Create Currency" @ok="createCurrency($event)">
            <b-form-group label="Currency" v-if="Object.keys(dataAvailableCurrencies)">
                <b-select class="form-select" v-model="newCurrency">
                     <b-select-option value="" disabled>Seçiniz</b-select-option>
                     <b-select-option value="" v-for="(option, index) in dataAvailableCurrencies.list" :value="option.code" :key="index">{{ option.code }} - {{ option.name }}</b-select-option>
                </b-select>
            </b-form-group>
        </b-modal>

    </content-page>

</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import CardContent from "../../components/layout/userDetail/cardContent";
import {mapActions, mapGetters} from "vuex";
import LoadingSpinner from "../../components/widgets/loadingSpinner";
import NoData from "../../components/widgets/alert/noData";

export default {
    name: "currencies",
    components: {NoData, LoadingSpinner, CardContent, ContentPage},
    data() {
        return {
            loading: true,
            newCurrency: '',
            fields: [
                {
                    key: 'name'
                },
                {
                    key: 'code'
                },
                {
                    key: 'symbol'
                },
                {
                    key: 'status'
                }
            ]
        }
    },
    computed: {
        ...mapGetters({
            dataCurrencies: 'Settings/getterCurrencies',
            dataAvailableCurrencies: 'Settings/getterAvailableCurrencies'
        })
    },
    methods: {
        ...mapActions({
            getCurrenciesAction: 'Settings/getCurrencies',
            setCurrencyStatus: 'Settings/setCurrencyStatus',
            getAvailableCurrenciesAction: 'Settings/getAvailableCurrencies',
            createCurrencyAction: 'Settings/createCurrency'
        }),
        getCurrencies() {
            this.loading = true
            this.getCurrenciesAction().then(() => {
                this.loading = false
            })
        },
        updateCurrencyStatus(data, status, event) {
            event.preventDefault()
            event.target.disabled = true
            this.setCurrencyStatus({
                id: data.item.id,
                status: status
            }).then(() => {
                this.dataCurrencies.list[data.index].status = status
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
        openCreateCurrencyModal(event) {
            event.preventDefault()
            event.target.disabled = true
            this.getAvailableCurrenciesAction().then(() => {
                this.$bvModal.show('create-currency')
                event.target.disabled = false
            })
        },
        createCurrency(event){
            event.preventDefault()
            this.createCurrencyAction({
                currency: this.newCurrency
            }).then(() => {
                this.getCurrencies()
                this.$bvModal.hide('create-currency')
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                })
            }).catch(error => {
                let errors
                if (error.errors){
                    errors = Object.values(error.errors)
                    errors.forEach(item => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Error',
                            text: item[0]
                        });
                    })
                }
                if (error.status === false && !error.errors){
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Error',
                        text: error.message
                    });
                }
            })
        }
    },
    created() {
        this.getCurrencies()
    }
}
</script>

<style scoped>

</style>
