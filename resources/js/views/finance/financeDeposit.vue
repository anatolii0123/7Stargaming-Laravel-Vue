<template>
    <content-page>
        <div class="col-md-12">
            <card-content title="FİLTRE">
                <template v-slot:content>
                    <div class="row filterGroupDefault">
                        <div class="col-md-2 userFilterInput userFilterDiv">
                            <input type="number" class="form-control" placeholder="ID ile Arayın">
                        </div>
                        <div class="col-md-2 userFilterInput userFilterDiv">
                            <select class="form-select">
                                <option selected="">Seçiniz</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-2 userFilterInput userFilterDiv">
                            <select class="form-select">
                                <option selected="">Seçiniz</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-2 userFilterInput userFilterDiv">
                            <input class="form-control" id="example-date" type="date" name="date">
                        </div>
                        <div class="col-md-4 userFilterInput userFilterDiv userButton">
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                SONUÇLAR
                            </button>
                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                SIRALA
                            </button>
                        </div>

                    </div>
                </template>
            </card-content>
            <card-content title="PARA YATIRIMLARI">
            <template v-slot:sortButtons>
                <button type="button" class="btn btn-success waves-effect waves-light">
                    HEPSİ</button>
                <button type="button" class="btn btn-light waves-effect waves-light">
                    ONAYLANDI</button>
                <button type="button" class="btn btn-light waves-effect waves-light">
                    REDDEDİLDİ</button>
                <select class="form-select">
                    <option selected="">SIRALAMA</option>
                    <option value="1">Sıra 1</option>
                    <option value="2">Sıra 2</option>
                    <option value="3">Sıra 3</option>
                </select>
            </template>
            <template v-slot:content>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Servis</th>
                            <th>Tür</th>
                            <th>Kullanıcı Adı</th>
                            <th>Üye</th>
                            <th>Miktar</th>
                            <th>Talep Tarihi</th>
                            <th>İşlem Tarihi</th>
                            <th>Açıklama</th>
                            <th>Admin Not</th>
                            <th>Durumu</th>
                            <th>İşlem</th>
                            <th>Detay</th>
                            <th>Admin</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td><div class="row bankType">
                                <div class="col-md-6">İş Bankası</div>
                                <div class="col-md-6"><i class="mdi mdi-sticker-plus"></i></div>
                            </div></td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-success waves-effect waves-light">
                                ONAYLANDI</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td>-</td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-danger waves-effect waves-light">
                                REDDEDİLDİ</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td>-</td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-success waves-effect waves-light">
                                ONAYLANDI</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td>-</td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-success waves-effect waves-light">
                                ONAYLANDI</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td>-</td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-success waves-effect waves-light">
                                ONAYLANDI</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td>-</td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-success waves-effect waves-light">
                                ONAYLANDI</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>
                        <tr>
                            <td scope="row">#1</td>
                            <td>Papara</td>
                            <td>-</td>
                            <td>muratszr</td>
                            <td>Murat Sözer</td>
                            <td><b>20.00 TRY</b></td>
                            <td>2021-07-11 17:25:11</td>
                            <td>2021-07-11 17:25:11</td>
                            <td>-</td>
                            <td>Çekim Bonusu</td>
                            <td><button type="button" class="btn btn-success waves-effect waves-light">
                                ONAYLANDI</button></td>
                            <td>-</td>
                            <td>-</td>
                            <td>Arda Gezer</td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </template>
        </card-content>
        </div>
    </content-page>

</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import CardContent from "../../components/layout/userDetail/cardContent";
export default {
    name: "financeDeposit",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
