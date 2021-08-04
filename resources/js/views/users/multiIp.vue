<template>
    <content-page>
        <content-title title="Multi IP">
                <div class="col-md-1 defaultFilter dateRange">
                    <p>Tarih Aralığı :</p>
                </div>
                <div class="col-md-2 defaultFilter defaultFilterDiv">
                    <input class="form-control"
                           type="datetime-local" name="date"
                           v-model="filter.start_date">
                </div>
                <div class="col-md-1 defaultFilter brace">-</div>
                <div class="col-md-2 defaultFilter defaultFilterDiv">
                    <input class="form-control"
                           type="datetime-local" name="date"
                           v-model="filter.end_date">
                </div>
                <div class="col-md-1 defaultFilter defaultFilterDiv filterButton">
                    <button @click="setMultiIp" class="btn btn-success waves-effect waves-light">
                        <i class="fas fa-search"></i> ARA
                    </button>
                </div>

        </content-title>
        <table-title title="Multi IP list" :loading="loading" :no-data="multiIp.list.total">
                <template v-slot:table>
                    <b-table
                        v-if="!loading && multiIp.list.total > 0"
                        :items="multiIp.list.data"
                        :fields="fields"
                        class="table-bordered mb-0"
                    >
                        <template #cell(username)="data">
                            {{ data.item.username }} <strong class="text-danger">[{{
                                data.item.count
                            }}]</strong>
                        </template>

                        <template #cell(accounts)="data">
                            <b-button
                                @click="setMultiIpAccounts(data.item.accounts)" size="sm">
                                Hesap Detayları
                            </b-button>
                        </template>

                    </b-table>
                </template>
                <template v-slot:nav>
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="multiIp.list.total"
                        :per-page="multiIp.list.per_page"
                        align="center"
                        v-if="multiIp.list.total > 0"
                        class="mt-2"
                    ></b-pagination>
                </template>
        </table-title>


        <multi-ip-accounts-modal :data="multiIpAccounts"></multi-ip-accounts-modal>
    </content-page>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ContentPage from "../../components/layout/page/contentPage";
import ContentTitle from "../../components/layout/page/contentTitle";
import TableTitle from "../../components/layout/page/tableTitle";
import MultiIpAccountsModal from "../../components/widgets/user/multiIpAccountsModal";

export default {
    name: "multiIp",
    components: {MultiIpAccountsModal, TableTitle, ContentTitle, ContentPage},
    data() {
        return {
            loading: true,
            currentPage: 1,
            filter: {
                start_date: this.toDatetimeLocalCustomHour('00:00'),
                end_date: this.toDatetimeLocalCustomHour('23:59'),
                page: 1
            },
            fields: [
                {
                    key: 'id',
                },
                {
                    key: 'username',
                },
                {
                    key: 'last_login_ip_address',
                    label: 'IP Adress',
                },
                {
                    key: 'accounts',
                    label: ' '
                }
            ],
            multiIpAccounts: {}
        }
    },
    computed: {
        ...mapGetters({
            multiIp: 'UserManagement/multiIp'
        })
    },
    methods: {
        ...mapActions({
            getMultiIp: 'UserManagement/getMultiIp'
        }),
        setMultiIp() {
            this.loading = true
            this.getMultiIp(this.filter).then(() => {
                this.loading = false

            }).catch(() => {
                this.loading = false
                alert('bir hata oluştu!')
            })
        },
        setMultiIpAccounts(data) {
            this.multiIpAccounts = data
            this.$bvModal.show('multiIpAccounts')
        }
    },
    created() {
        this.setMultiIp()

    },
    watch: {
        currentPage: {
            handler: function () {
                this.filter.page = this.currentPage
                this.setMultiIp()
            }
        },
    },

}
</script>

<style scoped>

</style>
