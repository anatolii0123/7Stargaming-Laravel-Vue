<template>
    <content-page>
        <content-title title="Kullanıcılar">
            <div class="row">
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.id" type="number" class="form-control" placeholder="ID">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.username" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.phone_number" type="text" class="form-control" placeholder="Phone Number">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.email" type="text" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.identity_number" type="number" class="form-control"
                           placeholder="Identity Number">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input type="ipAddress" v-model="filter.ip_address" class="form-control" placeholder="Ip Address">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <input v-model="filter.create_date" type="date" class="form-control" id=""
                           placeholder="Register Date">
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <b-select :options="affiliates.list" text-field="username" value-field="id" class="form-select"
                              v-model="filter.affiliate_id">

                        <template #first>
                            <b-form-select-option value="null">Affilates Seçiniz</b-form-select-option>
                        </template>
                    </b-select>
                </div>
                <div class="col-md-1 userFilterInput userFilterDiv">
                    <b-select :options="customerGroups.list" text-field="name" value-field="id" class="form-select"
                              v-model="filter.group_id">
                        <template #first>
                            <b-form-select-option value="null">Oyuncu Grubu Seçiniz</b-form-select-option>
                        </template>
                    </b-select>
                </div>
                <div class="col-md-2 userFilterInput userFilterDiv">
                    <button type="button" class="btn btn-success waves-effect waves-light" @click="formFilterSumbit">
                        Search
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" @click="formFilterReset">
                        Reset
                    </button>
                </div>
            </div>
        </content-title>
        <table-title title="Kulllanıcı Listesi" :loading="loading" :no-data="users.list.total" :enableNew="false" >
            <template v-slot:table>
                <b-table
                    :items="users.list.data"
                    :fields="fields"
                    v-if="!loading && users.list.total > 0"
                    @sort-changed="sortingChanged"
                    :sort-by="filter.sort_key"
                    :sort-desc="filter.sort_value"
                    striped
                    class="table-bordered"
                >

                    <template #cell(username)="data">
                        {{ data.item.username }}
                        <span
                            v-if="data.item.online === 1"
                            class="btn btn-xs btn-warning waves-effect waves-light text-white">
                            Aktif
                        </span>
                    </template>
                    <template #cell(balance)="data">
                        <span :class="{'text-danger': data.item.balance > 0}">{{ data.item.balance }}</span>
                        {{ data.item.currency }}
                    </template>
                    <template #cell(customer_group)="data">
                        <button
                            v-if="data.item.group_id > 0"
                            type="button"
                            class="btn btn-xs btn-success waves-effect waves-light"
                            :style="{backgroundColor:  data.item.group_color, borderColor: data.item.group_color}">
                            <span class="btn-label"><i :class="data.item.group_icon"></i></span>{{
                                data.item.group_name
                            }}
                        </button>
                    </template>

                    <template #cell(affiliate_id)="data">
                        <router-link
                            v-if="data.item.affiliate_id > 0"
                            to="/"
                            class="btn btn-xs btn-blue waves-effect waves-light">
                            {{ data.item.affiliate_name | uppercase }}
                        </router-link>
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
                    v-if="users.list.total > 0"
                    v-model="currentPage"
                    :total-rows="users.list.total"
                    :per-page="users.list.per_page"
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
    name: "list",
    components: {TableTitle, ContentTitle, ContentPage},
    data() {
        return {
            loading: true,
            currentPage: 1,
            filter: {
                id: null,
                username: null,
                phone_number: null,
                email: null,
                identity_number: null,
                ip_address: null,
                create_date: null,
                affiliate_id: null,
                group_id: null,
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
                    sortable: true
                },
                {
                    key: 'surname',
                    sortable: true
                },
                {
                    key: 'username',
                    sortable: true
                },
                {
                    key: 'identity_number',
                    sortable: true
                },
                {
                    key: 'balance',
                    sortable: true
                },
                {
                    key: 'online_date',
                    label: 'Son Giriş Tarihi',
                    sortable: true
                },
                {
                    key: 'create_date',
                    label: 'Kayıt Tarihi',
                    sortable: true
                },
                {
                    key: 'customer_group',
                    label: 'Üye Grubu'
                },
                {
                    key: 'affiliate_id',
                    label: 'Affiliate Hesabı'
                },
                {
                    key: 'action'
                }

            ]
        }
    },
    computed: {
        ...mapGetters({
            affiliates: 'Filter/getterAffiliates',
            customerGroups: 'Filter/getterCustomerGroup',
            users: 'Users/getterUserData'
        })
    },
    methods: {
        ...mapActions({
            getAffiliates: 'Filter/getAffiliates',
            getCustomerGroups: 'Filter/getCustomerGroups',
            getUsers: 'Users/getUserData'
        }),
        getUsersData() {
            this.loading = true
            this.getUsers(this.filter).then(response => {
                this.loading = false
            })
        },
        sortingChanged(sort) {
            this.filter.sort_key = sort.sortBy
            this.filter.sort_value = sort.sortDesc
            this.getUsersData()
        },
        formFilterSumbit() {
            this.getUsersData()
        },
        formFilterReset() {
            this.filter = {
                id: null,
                username: null,
                phone_number: null,
                email: null,
                identity_number: null,
                ip_address: null,
                create_date: null,
                affiliate_id: null,
                group_id: null,
                page: 1,
                sort_key: null,
                sort_value: null
            }
        }
    },
    created() {
        this.getAffiliates(() => {

        })
        this.getCustomerGroups(() => {

        })

        this.getUsersData()
    },
    watch: {
        currentPage: {
            handler: function () {
                this.filter.page = this.currentPage
                this.getUsersData()
            }
        },
    },
}
</script>

<style scoped>

</style>
