<template>
    <content-page>
        <div class="row userMoveListDetail">
                <card-content title="KULLANICI HAREKETLERİ">
                    <template v-slot:buttons>
                        <button type="button" class="btn btn-blue  waves-effect waves-light">CASINO / SLOT GİZLE</button>
                    </template>
                    <template v-slot:content>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                    <tr>
                                        <th class="tbl10">ID</th>
                                        <th class="tbl30">Hareket Türü</th>
                                        <th class="tbl20">Önceki Bakiye</th>
                                        <th class="tbl20">Tutar</th>
                                        <th class="tbl20">Sonraki Bakiye</th>
                                        <th class="tbl30">Tarih</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bettingMake">
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr class="bettingLose">
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr>
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr>
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr class="bettingWin">
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr>
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr>
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr>
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    <tr>
                                        <td>71</td>
                                        <td>Kazandı</td>
                                        <td>5.65 TRY</td>
                                        <td><b>40.95 TRY</b></td>
                                        <td>46.60</td>
                                        <td>2020-04-13 17:34:40</td>
                                    </tr>
                                    </tbody>
                                </table>
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
name: "transactions",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
