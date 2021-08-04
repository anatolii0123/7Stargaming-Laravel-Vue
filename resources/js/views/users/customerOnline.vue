<template>
    <content-page>
        <table-title title="Online Customer" :enableNew="false" :loading="loading" :no-data="onlineCustomerData.total">
            <template v-slot:table>
                <b-table
                    :items="onlineCustomerData.data"
                    :fields="fields"
                    v-if="!loading && onlineCustomerData.total > 0"
                    @sort-changed="sortingChanged"
                    :sort-by="filter.sort_key"
                    :sort-desc="filter.sort_value"
                    striped
                    class="table-bordered"
                >
                    <template #cell(balance)="data">
                        <span :class="{'text-danger': data.item.balance > 0}">{{ data.item.balance }}</span>
                        {{ data.item.currency }}
                    </template>
                    <template #cell(action)="data">
                        <router-link
                            :to="{ name: 'userDetail', params: {id: data.item.id} }"
                            class="btn btn-xs btn-success waves-effect waves-light">Detay
                        </router-link>
                    </template>
                </b-table>
            </template>
            <template v-slot:nav>
                <b-pagination
                    v-if="onlineCustomerData.total > 0"
                    v-model="currentPage"
                    :total-rows="onlineCustomerData.total"
                    :per-page="onlineCustomerData.per_page"
                    align="center"
                    class="mt-2">
                </b-pagination>
            </template>
        </table-title>
    </content-page>
</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import ContentTitle from "../../components/layout/page/contentTitle";
import TableTitle from "../../components/layout/page/tableTitle";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "customerOnline",
    components: {TableTitle, ContentTitle, ContentPage},
    data() {
        return {
            loading: true,
            currentPage: 1,
            filter: {
                id: null,
                name: null,
                surname: null,
                username: null,
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
                    key: 'name',
                    label: 'Name',
                    sortable: true
                },
                {
                    key: 'surname',
                    label: 'SureName',
                    sortable: true
                },                
                {
                    key: 'balance',
                    label: 'Balance',
                    sortable: true
                },
                {
                    key: 'username',
                    label: 'Username',
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
            onlineCustomerData: 'Users/getterOnlineCustomerData'
        })
    },
    methods: {
        ...mapActions({
            getOnlineCustomerData: 'Users/getOnlineCustomerData'
        }),
        getPageData() {
            this.loading = true
            this.getOnlineCustomerData(this.filter).then(response => {
                this.loading = false
            })
        },
        sortingChanged(sort) {
            this.filter.sort_key = sort.sortBy
            this.filter.sort_value = sort.sortDesc
            this.getPageData()
        },
        formFilterSumbit() {
            this.getPageData()
        },
        formFilterReset() {
            this.filter = {
                id: null,
                username: null,
                page: 1,
                sort_key: null,
                sort_value: null
            }
        }
    },
    created() {
        this.getPageData()
    },
    watch: {
        currentPage: {
            handler: function () {
                this.filter.page = this.currentPage
                this.getPageData()
            }
        },
    },
}
</script>

<style scoped>

</style>
