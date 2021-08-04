<template>
    <content-page>
        <div class="row">
            <div class="col-md-3">
                <card-content title="BONUS">
                    <template v-slot:content>
                        <div class="row bonusCardDetail">
                            <div class="bonusEditContent">
                                <div class="prEdit">
                                    <label for="simpleinput" class="form-label">Son Yatırımı</label>
                                    <input type="text" id="simpleinput" class="form-control">
                                </div>
                                <div class="prEdit">
                                    <label for="simpleinput" class="form-label">Eklenebilir Bonuslar</label>
                                    <select class="form-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="ptEdit">
                                    <button type="button" class="btn btn-success waves-effect waves-light">
                                        TANIMLA
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </card-content>
                <card-content title="FREESPİN">
                    <template v-slot:content>
                        <div class="bonusEditContent">
                            <div class="prEdit">
                                <label for="simpleinput" class="form-label">Oyun</label>
                                <select class="form-select">
                                    <option selected="">Seçiniz</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="prEdit">
                                <label for="simpleinput" class="form-label">Eklenebilir Bonuslar</label>
                                <input type="text" id="simpleinput" class="form-control">
                            </div>
                            <div class="ptEdit">
                                <button type="button" class="btn btn-success waves-effect waves-light">
                                    TANIMLA
                                </button>
                            </div>
                        </div>
                    </template>
                </card-content>
            </div>
            <div class="col-md-3">
                <card-content title="FREEBET">
                    <template v-slot:content>
                        <div class="row bonusCardDetail">
                            <div class="col-md-12 bonusEditContent">
                                <div class="prEdit">
                                    <label for="simpleinput" class="form-label">Eklenebilir Bonuslar</label>
                                    <select class="form-select">
                                        <option selected="">Seçiniz</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="ptEdit">
                                    <button type="button" class="btn btn-success waves-effect waves-light">
                                        TANIMLA
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </card-content>
            </div>
            <div class="col-md-6">
                <card-content title="BONUS GEÇMİŞİ">
                    <template v-slot:buttons>
                        <button type="button" class="btn btn-success  waves-effect waves-light">HEPSİ</button>
                        <button type="button" class="btn btn-light  waves-effect waves-light">AKTİF</button>
                        <button type="button" class="btn btn-light  waves-effect waves-light">KAZANDI</button>
                        <button type="button" class="btn btn-light  waves-effect waves-light">KAYBETTİ</button>
                        <button type="button" class="btn btn-light  waves-effect waves-light">İPTAL OLDU</button>
                    </template>
                    <template v-slot:content>
                        <div class="row bonusCardDetail">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th>Bonus Adı</th>
                                        <th>Bonus Tutarı</th>
                                        <th>Kalan Çevrim Tutarı</th>
                                        <th>Aldığı Tarih</th>
                                        <th>Durumu</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Freespin Eklendi</td>
                                        <td>10 Adet</td>
                                        <td><b>Oyun :</b> netent:twinspin_mobile_html_sw<br><b>Admin:</b> admin</td>
                                        <td>2020-04-13 17:34:40</td>
                                        <td><button type="button" class="btn btn-success waves-effect waves-light">
                                            KAZANDI
                                        </button></td>
                                    </tr>
                                    <tr>
                                        <td>20 TL Free Bet</td>
                                        <td>20.00 TRY</td>
                                        <td><button type="button" class="btn btn-blue waves-effect waves-light">
                                            GÖSTER
                                        </button> <button type="button" class="btn btn-danger waves-effect waves-light">
                                            KAPANMA BİLGİLERİ
                                        </button></td>
                                        <td>2020-04-13 17:34:40</td>
                                        <td><button type="button" class="btn btn-danger waves-effect waves-light">
                                            KAYBETTİ
                                        </button></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </card-content>
            </div>
        </div>
    </content-page>
</template>

<script>
import ContentPage from "../../../components/layout/page/contentPage";
import CardContent from "../../../components/layout/userDetail/cardContent";
export default {
    name: "bonuses",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
