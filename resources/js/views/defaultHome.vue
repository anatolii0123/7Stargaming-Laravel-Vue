<template>
    <div class="content">
        <div id="moduleContent" class="container-fluid" v-if="!loading">
            <div class="row" style="padding-top:25px;  margin: 5px -15px 0px -5px;">
                <StatisticsCard
                    v-for="item in statisticsCards"
                    v-bind:key="item.id"
                    v-bind:title="item.title"
                    v-bind:memNumber="item.memNumber"
                    v-bind:color="item.color"
                    v-bind:icon="item.icon"
                ></StatisticsCard>
            </div>
            <!-- end row-->

            <div id="contentDown" class="row">
                <div class="col-md-4">
                    <div class="widget-rounded-circle card">
                        <div class="card-body" style="height:170px;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-end">
                                        <p class="text-muted newClass mb-1 text-truncate">
<!--                                            <span v-if="currencyIsThere('USD')">USD: {{ currencyIsThere('USD') }}</span>-->
<!--                                            <span v-if="currencyIsThere('EUR')">USD: {{ currencyIsThere('EUR') }}</span>-->
                                            Para Birimi
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <p class="updateHistory">
                                            {{ $t(1647) }}: <b>{{ this.dashboardData.currency_last_updated }}</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label>Currency Unit:</label>
                                        <b-select :options="currency" v-model="activeCurrency" class="form-select" @change="currencyChance"></b-select>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <StatisticsDepositCard
                    v-for="item in statisticsDepositCards"
                    v-bind:key="item.id"
                    v-bind:cardInfo="item"
                    :currency="activeCurrency"
                >
                </StatisticsDepositCard>
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="tooltip-container">
                        <div class="card-body">
                            <p style="font-size:15px;" class="text-muted mb-0">
                                {{ $t(1648) }} <b style="color:red;">{{ $t(1647) }}:</b> {{this.dashboardData.last_updated}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <StatisticsProfitCard
                    v-for="item in statisticsProfitCards"
                    v-bind:key="item.id"
                    v-bind:item="item"
                    :currency="activeCurrency"
                >
                </StatisticsProfitCard>
            </div>
            <!-- end row -->

            <div id="menuBottom" class="row">
                <div class="col-md-2">
                    <a href="#">
                    </a><div id="bottomMenu" class="card couponsTop"><a href="#">
                    <div class="card-body">
                        <div class="col-md-12"><i class="fas fa-clipboard-list coupons"></i></div>
                        <div class="col-md-12"><h4 class="header-title mb-0 grafContentTitle">KUPONLAR</h4></div>

                    </div> </a><!-- end card-body -->
                </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-md-2">
                    <a href="#">
                    </a><div id="bottomMenu" class="card membersTop"><a href="#">
                    <div class="card-body">
                        <div class="col-md-12"><i class="fas fa-user-friends members"></i></div>
                        <div class="col-md-12"><h4 class="header-title mb-0 grafContentTitle">ÜYELER</h4></div>

                    </div></a> <!-- end card-body -->
                </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-md-2">
                    <a href="#">
                    </a><div id="bottomMenu" class="card messageTop"><a href="#">
                    <div class="card-body">
                        <div class="col-md-12"><i class="fas fa-clipboard-list message"></i></div>
                        <div class="col-md-12"><h4 class="header-title mb-0 grafContentTitle">MESAJLAR</h4></div>

                    </div></a> <!-- end card-body -->
                </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-md-2">
                    <a href="#">
                    </a><div id="bottomMenu" class="card documentTop"><a href="#">
                    <div class="card-body">
                        <div class="col-md-12"><i class="fas fa-clipboard-list document"></i></div>
                        <div class="col-md-12"><h4 class="header-title mb-0 grafContentTitle">DÖKÜMANLAR</h4></div>

                    </div></a> <!-- end card-body -->
                </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-md-2">
                    <a href="#">
                    </a><div id="bottomMenu" class="card sessionTop"><a href="#">
                    <div class="card-body">
                        <div class="col-md-12"><i class="fas fa-clipboard-list session"></i></div>
                        <div class="col-md-12"><h4 class="header-title mb-0 grafContentTitle">OTURUMLAR</h4></div>

                    </div> </a><!-- end card-body -->
                </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-md-2">
                    <a href="#">
                    </a><div id="bottomMenu" class="card reportTop"><a href="#">
                    <div class="card-body">
                        <div class="col-md-12"><i class="fas fa-clipboard-list report"></i></div>
                        <div class="col-md-12"><h4 class="header-title mb-0 grafContentTitle">RAPORLAR</h4></div>
                    </div> </a><!-- end card-body -->
                </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
        </div>
        <div class="col-md-12 text-center" v-if="loading">
            <div
                class="spinner-border avatar-md text-primary m-2 text-center"
                role="status"
            ></div>
        </div>
    </div>
</template>

<script>
    import StatisticsCard from "../components/widgets/dashboard/StatisticsCard";
    import StatisticsDepositCard from "../components/widgets/dashboard/StatisticsDepositCard";
    import StatisticsProfitCard from "../components/widgets/dashboard/StatisticsProfitCard";

    import {mapActions , mapGetters} from "vuex";

    export default {
        name: "defaultHome",
        data() {
            return {
                statisticsCards:[],
                statisticsDepositCards:[],
                statisticsProfitCards:[],
                currency : [],
                activeCurrency: '',
                loading: true
            };
        },
        components: {
            StatisticsCard,
            StatisticsDepositCard,
            StatisticsProfitCard,
        },
        computed:{
            ...mapGetters({
               dashboardData: 'Dashboard/getterDashboardData'
            })
        },
        methods: {
            ...mapActions({
                getDashboardData: 'Dashboard/getDashboardData',
                setChanceCurrency: 'Dashboard/setChanceCurrency'
            }),
            currencyIsThere(par){
                if (this.dashboardData.currencies[par]) return this.dashboardData.currencies[par]
                return false
            },
            initCurrency(){
                this.currency = []
                let data = this.dashboardData.currencies;
                if(data){
                    Object.entries(data).forEach(item => {
                        this.currency.push({text: item[0], value: item[0]})
                    })
                }
                this.activeCurrency = this.dashboardData.currency
            },
            parentFunction(gameType){
                alert(gameType);
            },
            initStatisticsCard(){
                this.statisticsCards = [
                    {
                        id : "1",
                        title:this.$t(1637).toUpperCase() ,
                        icon:"fas fa-user-plus",
                        memNumber:this.dashboardData.counter_statistics.daily_user,
                        color:'#79ab3f'
                    },
                    {
                        id : "2",
                        title:this.$t(1638).toUpperCase(),
                        icon:"fab fa-telegram-plane",
                        memNumber:this.dashboardData.counter_statistics.instant_active,
                        color:'#2ebcd5'
                    },
                    {
                        id : "3",
                        title:this.$t(1639).toUpperCase(),
                        icon:"fas fa-users",
                        memNumber:this.dashboardData.counter_statistics.daily_active,
                        color:'#b88a15'
                    },
                    {
                        id : "4",
                        title:this.$t(1640).toUpperCase(),
                        icon:"fas fa-user-friends",
                        memNumber:this.dashboardData.counter_statistics.total_members,
                        color:'#f60f1a'
                    },
                    {
                        id : "5",
                        title:this.$t(1641).toUpperCase(),
                        icon:"fas fa-money-bill-wave",
                        memNumber:this.dashboardData.counter_statistics.total_member_vault,
                        color:'#b6b8bb'
                    },
                    {
                        id : "6",
                        title:this.$t(1642).toUpperCase(),
                        icon:"fab fa-buffer",
                        memNumber:this.dashboardData.counter_statistics.monthly_coupon,
                        color:'#2ebcd5'
                    },
                    {
                        id : "7",
                        title:this.$t(1643).toUpperCase(),
                        icon:"fab fa-buffer",
                        memNumber:this.dashboardData.counter_statistics.daily_coupon,
                        color:'#79ab3f'
                    },
                ]
            },

            initStatisticsDepositCard(){
                this.statisticsDepositCards = [
                    {
                        id:"1",
                        title:"Daily Deposit",
                        type:"Daily_Deposit",
                        data:this.dashboardData.daily_deposit,
                        miniBtnClass:"fas fa-plus-square",
                        miniBtnColor:"#79ab3f"
                    },
                    {
                        id:"2",
                        title:"Daily Withdraw",
                        type:"Daily_Withdraw",
                        data:this.dashboardData.daily_withdraw,
                        miniBtnClass:"fas fa-minus-square",
                        miniBtnColor:"#f60f1a"
                    },
                    {
                        id:"3",
                        title:"Monthly Deposit",
                        type:"Monthly_Deposit",
                        data:this.dashboardData.monthly_deposit,
                        miniBtnClass:"fas fa-plus-square",
                        miniBtnColor:"#79ab3f"
                    },
                    {
                        id:"4",
                        title:"Monthly Withdraw",
                        type:"Monthly_Withdraw",
                        data:this.dashboardData.monthly_withdraw,
                        miniBtnClass:"fas fa-minus-square",
                        miniBtnColor:"#f60f1a"
                    },
                ]
            },

            initStatisticsProfitCard(){
                this.statisticsProfitCards = [
                    {
                        id : "1",
                        title : "COUPON PROFIT",
                        type : "coupon",
                        daily : this.dashboardData.reports.daily.coupon,
                        monthly : this.dashboardData.reports.monthly.coupon,
                    },
                    {
                        id : "2",
                        title : "SLOT PROFIT",
                        type : "slot",
                        daily : this.dashboardData.reports.daily.slot,
                        monthly : this.dashboardData.reports.monthly.slot,
                    },
                    {
                        id : "3",
                        title : "CASINO PROFIT",
                        type : "casino",
                        daily : this.dashboardData.reports.daily.casino,
                        monthly : this.dashboardData.reports.monthly.casino
                    },

                ]
            },

            setDashboardData(){
                this.loading = true
                this.getDashboardData().then(() => {
                    this.initStatisticsCard();
                    this.initStatisticsDepositCard();
                    this.initStatisticsProfitCard();
                    this.initCurrency();
                    this.loading  = false
                }).catch(() => {
                    this.loading = true
                })
            },

            currencyChance(){
                this.setChanceCurrency({currency: this.activeCurrency}).then(() => {
                    this.setDashboardData()
                })
            }

        },
        created() {
            this.setDashboardData()
        },
    }
</script>

<style scoped>

</style>
