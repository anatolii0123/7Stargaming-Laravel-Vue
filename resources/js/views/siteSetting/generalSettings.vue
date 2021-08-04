<template>
    <content-page>
        <div class="col-md-6" v-if="!loading">
            <card-content title="SİTE AYARLARI">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveGeneralSetting"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:generalContent>
                    <div class="row pR0">
                        <div class="table-responsive pR0">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Site Adı</th>
                                        <td>
                                            <input class="form-control" type="text" v-model="gsData.name" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Site Adresi</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.address">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Site Başlık</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.title">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Site Açıklama</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.description">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Anahtar Kelimeler</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.keywords">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-Posta Adresi</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.email">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Varsayılan Dil</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.lang">
                                                <option value="tr">Türkçe</option>
                                                <option value="en">İngilizce</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-6" v-if="!loading">
            <card-content title="YÖNLENDİRME">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveGeneralSetting"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:generalContent>
                    <div class="row pR0">
                        <div class="table-responsive pR0">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Otomatik Yönlendirme</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.auto_forwarding">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Anasayfa Yönlendirme</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.home_forwarding">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Çoklu Dil Seçeneği</th>
                                        <td><select class="form-select">
                                            <option selected="">Aktif</option>
                                            <option value="1">Pasif</option>
                                        </select></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Para Birimi</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.currency">
                                                <option value="TRY">TRY</option>
                                                <option value="IRR">IRR</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Saat Dilimi</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.timezone">
                                                <option value="-2">UTC -2</option>
                                                <option value="-1">UTC -1</option>
                                                <option value="+0">UTC 0</option>
                                                <option value="+1">UTC +1</option>
                                                <option value="+2">UTC +2</option>
                                                <option value="+3">UTC +3</option>
                                                <option value="+4">UTC +4</option>
                                                <option value="+5">UTC +5</option>
                                                <option value="+6">UTC +6</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-6" v-if="!loading">
            <card-content title="SİTE GÖRSELLERİ">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveGeneralSetting"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:generalContent>
                    <div class="row pR0">
                        <div class="table-responsive pR0">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Logo Görsel Adresi</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.logo_url">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Favicon Görsel Adresi</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.favicon_url">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Shop Kupon Logo</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="gsData.betslip_logo_url">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Shop Kupon Alt Açıklama</th>
                                        <td>
                                            <textarea class="form-control" rows="5" v-model="gsData.betslip_signature">
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">SSL Durumu</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.ssl_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-6" v-if="!loading">
            <card-content title="BAHİS AYARLARI">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveGeneralSetting"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:generalContent>
                    <div class="row pR0">
                        <div class="table-responsive pR0">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Bahis Durumu</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.betting_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Casino Durumu</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.casino_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Slot Durumu</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.slot_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Yeni Müşteri / Bahis</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.new_customer_betting_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Yeni Müşteri / Casino</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.new_customer_casino_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Yeni Müşteri / Slot</th>
                                        <td>
                                            <select class="form-select" v-model="gsData.new_customer_slot_status">
                                                <option value="1">Aktif</option>
                                                <option value="0">Pasif</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>

        <loading-spinner v-else></loading-spinner>

    </content-page>
</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import CardContent from "../../components/layout/userDetail/cardContent";
import DownCardContent from "../../components/layout/generalDetails/downCardContent";
import {mapActions, mapGetters} from "vuex";
import LoadingSpinner from "../../components/widgets/loadingSpinner";
export default {
    name: "generalSettings",
    components: {LoadingSpinner, DownCardContent, CardContent, ContentPage},
    data() {
        return {
            btnSaveActive: true,
            gsData: [],
            cloneData: [],
            loading: true
        }
    },
    computed: {
        ...mapGetters({
            generalSettings: 'Settings/getterGeneralSettings',
        })
    },
    methods: {
        ...mapActions({
            setGetGeneralSettings: 'Settings/getGeneralSettings',
            setUpdateGeneralSettings: 'Settings/updateGeneralSettings',
        }),
        getGeneralSetting() {
            this.setGetGeneralSettings().then(response => {
                this.gsData = this.generalSettings
                this.cloneData = _.cloneDeep(this.generalSettings)
                this.loading = false
            })
        },
        saveGeneralSetting() {
            this.setUpdateGeneralSettings(this.gsData).then(() => {
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                });
                this.getGeneralSetting();
            });
        }
    },
    created: function () {
        this.getGeneralSetting()
    },
    watch: {
        gsData: {
            handler: function () {
                let status = false;

                Object.keys(this.gsData).forEach(key => {
                    if (!status) {
                        status = this.gsData[key] !== this.cloneData[key];
                    }
                });

                this.btnSaveActive = !status;
            },
            deep: true
        }
    }
}
</script>

<style scoped>

</style>
