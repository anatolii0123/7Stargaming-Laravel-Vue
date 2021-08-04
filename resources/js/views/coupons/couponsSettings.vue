<template>
    <content-page>
        <div v-if="!loading" class="row">
<!--            <div class="col-md-4">-->
<!--                <card-content title="TEKLİ KUPON">-->
<!--                    <template v-slot:content>-->
<!--                        <div class="row couponsPad">-->
<!--                            <div class="col-md-12 dpFle">-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Minimum Bahis</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Maximum Kazanç</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="ptEdit">-->
<!--                                        <button type="button" class="btn btn-success waves-effect waves-light">-->
<!--                                            İŞLEMİ TAMAMLA-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </template>-->
<!--                </card-content>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                <card-content title="KOMBİNE KUPON">-->
<!--                    <template v-slot:content>-->
<!--                        <div class="row couponsPad">-->
<!--                            <div class="col-md-12 dpFle">-->
<!--                                <div class="col-md-3">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Minimum Bahis</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-3">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Maximum Kazanç</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-3">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Max. Maç</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-3">-->
<!--                                    <div class="ptEdit">-->
<!--                                        <button type="button" class="btn btn-success waves-effect waves-light">-->
<!--                                            İŞLEMİ TAMAMLA-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </template>-->
<!--                </card-content>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                <card-content title="SİSTEM KUPONU">-->
<!--                    <template v-slot:content>-->
<!--                        <div class="row couponsPad">-->
<!--                            <div class="col-md-12 dpFle">-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Minimum Bahis</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="prEdit">-->
<!--                                        <label for="simpleinput" class="form-label">Maximum Kazanç</label>-->
<!--                                        <input type="text" id="simpleinput" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <div class="ptEdit">-->
<!--                                        <button type="button" class="btn btn-success waves-effect waves-light">-->
<!--                                            İŞLEMİ TAMAMLA-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </template>-->
<!--                </card-content>-->
<!--            </div>-->
            <div class="col-md-12">
                <card-content title="Coupon Settings">
                    <template v-slot:buttons>
                        <button type="button" @click="formSubmit" class="btn btn-success btn-sm waves-effect waves-light" :disabled="btnSaveActive">KAYDET</button>
                    </template>
                    <template v-slot:content>
                        <div class="row preLimitCardDetail pR0 prPreLive">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Cashout Status</th>
                                        <td><input type="text" v-model="settings.cashout.status" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Cashout Commission</th>
                                        <td><input type="text" v-model="settings.cashout.commission" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Odds Balance </th>
                                        <td><input type="text" v-model="settings.odds_balance" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Live Coupon Waiting</th>
                                        <td><input type="text" v-model="settings.live_coupon_waiting" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Live Football Close</th>
                                        <td><input type="text" v-model="settings.live_football_close " class="form-control"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </card-content>
            </div>
            <div class="col-md-6">
                <card-content title="MAÇ ÖNCESİ">
                    <template v-slot:buttons>
                        <button type="button" @click="formSubmit" class="btn btn-success btn-sm waves-effect waves-light" :disabled="btnSaveActive">KAYDET</button>
                    </template>
                    <template v-slot:content>
                        <div class="row preLimitCardDetail pR0 prPreLive">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Minimum Kupon Tutarı</th>
                                        <td><input type="number" v-model="limits.pre_match.min_coupon_amount" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Kupon Tutarı</th>
                                        <td><input type="text" v-model="limits.pre_match.max_coupon_amount" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Kazanç</th>
                                        <td><input type="text" v-model="limits.pre_match.max_coupon_earning" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Bahis (Karşılaşma)</th>
                                        <td><input type="text" v-model="limits.pre_match.max_bet_event" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Bahis (Lig)</th>
                                        <td><input type="text" v-model="limits.pre_match.max_bet_league" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Bahis (Oran Tipi)</th>
                                        <td><input type="text" v-model="limits.pre_match.max_bet_odd_type" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minimum Tekli Oran</th>
                                        <td><input type="text" v-model="limits.pre_match.min_single_odd" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minimum Kombine Oran</th>
                                        <td><input type="text" v-model="limits.pre_match.min_combine_odd" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minimum Kombine İçi Tekli Oran</th>
                                        <td><input type="text" v-model="limits.pre_match.min_combine_single_odd" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Kombine Sayısı</th>
                                        <td><input type="text" v-model="limits.pre_match.max_combine_event" class="form-control"></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </card-content>
            </div>
            <div class="col-md-6">
                <card-content title="CANLI">
                    <template v-slot:buttons>
                        <button type="button" @click="formSubmit" class="btn btn-success btn-sm waves-effect waves-light" :disabled="btnSaveActive">KAYDET</button>
                    </template>
                    <template v-slot:content>
                        <div class="row preLimitCardDetail pR0 prPreLive">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Minimum Kupon Tutarı</th>
                                        <td><input type="text" v-model="limits.live.min_coupon_amount" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Kupon Tutarı</th>
                                        <td><input type="text" v-model="limits.live.max_coupon_amount" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Kazanç</th>
                                        <td><input type="text" v-model="limits.live.max_coupon_earning" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Bahis (Karşılaşma)</th>
                                        <td><input type="text" v-model="limits.live.max_bet_event" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Bahis (Lig)</th>
                                        <td><input type="text" v-model="limits.live.max_bet_league" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Bahis (Oran Tipi)</th>
                                        <td><input type="text" v-model="limits.live.max_bet_odd_type" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minimum Tekli Oran</th>
                                        <td><input type="text" v-model="limits.live.min_single_odd" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minimum Kombine Oran</th>
                                        <td><input type="text" v-model="limits.live.min_combine_odd" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Minimum Kombine İçi Tekli Oran</th>
                                        <td><input type="text" v-model="limits.live.min_combine_single_odd" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Kombine Sayısı</th>
                                        <td><input type="text" v-model="limits.live.max_combine_event" class="form-control"></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </card-content>
            </div>

        </div>
        <div class="col-md-12 text-center" v-else>
            <div
                class="spinner-border avatar-md text-primary m-2 text-center"
                role="status"
            ></div>
        </div>
    </content-page>

</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import CardContent from "../../components/layout/userDetail/cardContent";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "couponsSettings",
    components: {CardContent, ContentPage},
    data() {
        return {
            loading: true,
            limits:[],
            settings:[],
            postData: {},
            btnSaveActive: false
        }
    },
    computed: {
        ...mapGetters({
            couponSettingsData: 'Coupons/getterCouponSettings'
        })
    },
    methods: {
        ...mapActions({
            actionGetCouponSettings: 'Coupons/getCouponSettings',
            updateCouponSettings: 'Coupons/updateCouponSettings'
        }),
        getCouponSettings() {
            this.actionGetCouponSettings().then(response => {
                this.loading = false
                if (this.couponSettingsData.detail.limits) this.limits = _.cloneDeep(this.couponSettingsData.detail.limits)
                if (this.couponSettingsData.detail.settings) this.settings = _.cloneDeep(this.couponSettingsData.detail.settings)

            })
        },
        formSubmit(){
            this.btnSaveActive = true
            for (var [key, value] of Object.entries(this.limits.live)) {
                key = 'live_' + key
                this.postData[key] = value
            }
            for (var [key, value] of Object.entries(this.limits.pre_match)) {
                key = 'pre_' + key
                this.postData[key] = value
            }

            //settings
            this.postData['cashout_status'] = this.settings.cashout.status
            this.postData['cashout_commission'] = this.settings.cashout.commission
            this.postData['odds_balance'] = this.settings.odds_balance
            this.postData['live_coupon_waiting'] = this.settings.live_coupon_waiting
            this.postData['live_football_close'] = this.settings.live_football_close

            this.updateCouponSettings(this.postData).then(() => {
                this.btnSaveActive = false
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                });
            }).catch(error => {
                this.btnSaveActive = false
                if (error) {
                    error = Object.values(error)
                    error.forEach(item => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Error',
                            text: item[0]
                        });
                    })
                }
            })
        }
    },
    created() {
        this.getCouponSettings()
    },
    watch:{
        /*
        pre_match: {
            handler: function () {

                let status = false;
                Object.keys(this.pre_match).forEach(key => {
                    if (!status) {
                        status = this.pre_match[key] !== this.couponSettingsData.detail.limits.pre_match[key];
                    }
                });

                this.btnSaveActive = !status;
            },
            deep: true
        }
        */
    }

}
</script>

<style scoped>

</style>
