<template>
    <div>
        <div class="userNav" v-if="!loading">
            <div class="container-fluid">
                <div class="userBarLeft">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="userTitle">
                                    <h3><b>{{ user.first_name }} {{ user.last_name }}</b></h3>
                                    <span>({{ user.username }})</span>
                                    <a href="#"><i class="mdi mdi-account-multiple-check"></i></a>
                                    <a href="#"><i class="mdi mdi-cellphone-android"></i></a>
                                    <a href="#"><i class="mdi mdi-image-area"></i></a>
                                </div>
                                <div class="userName">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="userBarRight">
                    <div class="userRightTitle">
                        <!--                        <button type="button" style="    margin-bottom: 12px;-->
                        <!--                        margin-left: 8px;" class="btn btn-success waves-effect waves-light"><i-->
                        <!--                            class="mdi mdi-heart me-1"></i> Güncel Aktif Üye-->
                        <!--                        </button>-->

                        <button
                            v-if="user.group.id > 0"
                            type="button"
                            class="btn btn-xs btn-success waves-effect waves-light"
                            :style="{backgroundColor:  user.group.color, borderColor: user.group.color}">
                            <span class="btn-label"><i :class="user.group.icon"></i></span>
                            {{ user.group.name }}
                        </button>
                        <button type="button"
                                style="margin-bottom: 12px;margin-left: 8px;"
                                class="btn btn-secondary waves-effect waves-light"
                                v-else
                        >
                            <i class="mdi mdi-heart me-1"></i> Grup Seç
                        </button>

                        <button type="button" class="btn btn-danger waves-effect waves-light" @click="setMultiIpAccounts">IP Çakışmalarını Göster
                            ({{ user.multi_ip.count }})
                        </button>
                        <button type="button" class="btn btn-light waves-effect waves-light">Banka Bilgileri</button>
                        <h3>{{ user.balance | numFormat('0.00') }} {{ user.currency }}</h3>
                        <a href="javascript:void(0)"><i class="fas fa-cog"></i></a>
                    </div>
                </div>
            </div> <!-- end container-fluid -->
        </div>
        <div class="content" v-if="!loading">
            <div class="profileMenuNav">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="navbarProfile mr-auto">
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'userDetail'}"
                                    class="nav-link" exact
                                >
                                    <i class="fas fa-user"></i>
                                    Müşteri Özeti
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'informationUpdate'}"
                                             class="nav-link">
                                    <i class="fas fa-plus-circle"></i>
                                    Bilgi Güncelleme
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'userCoupons'}" class="nav-link"><i
                                    class="far fa-newspaper"></i>Kuponlar
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'userBonuses'}" class="nav-link"><i class="fas fa-star"></i>Bonuslar
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name:'userDiscount'}" class="nav-link"><i class="fas fa-gift"></i>Discount
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name:'userLimits'}" class="nav-link"><i class="fas fa-futbol"></i>Limitler
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name:'userMessages'}" class="nav-link"><i
                                    class="fab fa-rocketchat"></i>Mesajlar(0)
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'userDocumentManagement'}" class="nav-link"><i
                                    class="fas fa-image"></i>Belge Yönetimi
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'userTransactions'}" class="nav-link"><i
                                    class="fas fa-chart-line"></i>Kullanıcı
                                    Hareketleri
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name:'userFinancialStatistics'}" class="nav-link"><i
                                    class="fas fa-rocket"></i>Finansal
                                    İstatistikler
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'userCasinoMoves'}" class="nav-link"><i
                                    class="fas fa-chart-line"></i>Casino
                                    Hareketleri
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'userSlotMoves'}" class="nav-link"><i
                                    class="fas fa-chart-line"></i>Slot
                                    Hareketleri
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name:'userScorePredictionMoves'}" class="nav-link"><i
                                    class="fas fa-chart-line"></i>Skor
                                    Tahmin Hareketleri
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'userLogs'}" class="nav-link"><i class="fab fa-microblog"></i>Loglar
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <loading-spinner v-else></loading-spinner>
        <multi-ip-accounts-modal :data="multiIpAccounts"></multi-ip-accounts-modal>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import LoadingSpinner from "../../../components/widgets/loadingSpinner";
import MultiIpAccountsModal from "../../../components/widgets/user/multiIpAccountsModal";

export default {
    name: "userNav",
    components: {MultiIpAccountsModal, LoadingSpinner},
    data() {
        return {
            loading: true,
            user: null,
            multiIpAccounts: null
        }
    },
    computed: {
        ...mapGetters({
            dataUserNavInfo: 'UserDetail/getterUserNavInfo'
        }),
        queryUserId() {
            return this.$route.params.id
        }
    },
    methods: {
        ...mapActions({
            getUserNavInfoAction: 'UserDetail/getUserNavInfo'
        }),
        setMultiIpAccounts() {
            this.multiIpAccounts = this.user.multi_ip.accounts
            this.$bvModal.show('multiIpAccounts')
        }
    },
    created() {
        this.getUserNavInfoAction(this.queryUserId).then(() => {
            this.loading = false
            this.user = this.dataUserNavInfo.detail
        })
    }
}
</script>

<style scoped>

</style>
