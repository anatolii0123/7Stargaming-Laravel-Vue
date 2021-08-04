<template>
    <content-page>
        <div class="col-md-4">
            <card-content title="SKOR RAPORLARI">
                <template v-slot:content>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <th scope="row">Toplam Tahmin</th>
                                    <td><b>10</b></td>
                                </tr>
                                <tr>
                                    <th scope="row">Toplam Doğru Tahmin</th>
                                    <td><b>0</b></td>
                                </tr>
                                <tr>
                                    <th scope="row">Verilen Tutar</th>
                                    <td><b>0.00 TRY</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-8">
            <card-content title="FİLTRE">
                <template v-slot:content>
                    <div class="row filterGroupDefault">
                        <div class="col-md-4 userFilterInput userFilterDiv">
                            <input class="form-control" id="example-date" type="date" name="date">
                        </div>

                        <div class="col-md-1 userFilterInput userFilterDiv userButton">
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
            <card-content title="TAHMİN SKOR GEÇMİŞİ">
                <template v-slot:content>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th>Karşılaşma</th>
                                    <th>Simulator</th>
                                    <th>Tahmin Tarihi</th>
                                    <th>Tahmin</th>
                                    <th>Skor</th>
                                    <th>Durum</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>AS Roma - İstanbul Başakşehir FK</td>
                                    <td><button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chart-areaspline-variant"></i></button></td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>3-0</td>
                                    <td>4-0</td>
                                    <td><button type="button" class="btn btn-danger  waves-effect waves-light">KAYBETTİ</button></td>
                                </tr>
                                <tr>
                                    <td>AS Roma - İstanbul Başakşehir FK</td>
                                    <td><button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chart-areaspline-variant"></i></button></td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>3-0</td>
                                    <td>4-0</td>
                                    <td><button type="button" class="btn btn-danger  waves-effect waves-light">KAYBETTİ</button></td>
                                </tr>
                                <tr>
                                    <td>AS Roma - İstanbul Başakşehir FK</td>
                                    <td><button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chart-areaspline-variant"></i></button></td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>3-0</td>
                                    <td>4-0</td>
                                    <td><button type="button" class="btn btn-danger  waves-effect waves-light">KAYBETTİ</button></td>
                                </tr>
                                <tr>
                                    <td>AS Roma - İstanbul Başakşehir FK</td>
                                    <td><button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chart-areaspline-variant"></i></button></td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>3-0</td>
                                    <td>4-0</td>
                                    <td><button type="button" class="btn btn-danger  waves-effect waves-light">KAYBETTİ</button></td>
                                </tr>
                                <tr>
                                    <td>AS Roma - İstanbul Başakşehir FK</td>
                                    <td><button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chart-areaspline-variant"></i></button></td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>3-0</td>
                                    <td>4-0</td>
                                    <td><button type="button" class="btn btn-danger  waves-effect waves-light">KAYBETTİ</button></td>
                                </tr>
                                <tr>
                                    <td>AS Roma - İstanbul Başakşehir FK</td>
                                    <td><button type="button" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chart-areaspline-variant"></i></button></td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>3-0</td>
                                    <td>4-0</td>
                                    <td><button type="button" class="btn btn-danger  waves-effect waves-light">KAYBETTİ</button></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
    </content-page>

</template>

<script>
import ContentPage from "../../../components/layout/page/contentPage";
import CardContent from "../../../components/layout/userDetail/cardContent";
export default {
name: "scorePredictionMoves",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
