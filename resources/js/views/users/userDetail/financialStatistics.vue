<template>
    <content-page>
        <div class="col-md-4">
            <card-content title="RAPORLAR">
                <template v-slot:content>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <th scope="row">Toplam Yatırım</th>
                                <td><b>260.00 TRY</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Toplam Bonus</th>
                                <td><b>120.00 TRY</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Toplam Freebet</th>
                                <td><b>85.00 TRY</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Toplam Yatırım Adedi</th>
                                <td><b>8</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Toplam Çekim Adedi</th>
                                <td><b>0</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Toplam Discount Adedi</th>
                                <td><b>0</b></td>
                            </tr>
                            <tr>
                                <th scope="row">Net Kâr</th>
                                <td><b style="color:green;">345.00 TRY</b></td>
                            </tr>
                            </tbody>
                        </table>
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
            <card-content title="CASİNO GEÇMİŞİ">
                <template v-slot:content>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tür</th>
                                <th>Yöntem</th>
                                <th>Tutar</th>
                                <th>Eski Bakiye</th>
                                <th>Yeni Bakiye</th>
                                <th>Oluşturma Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>#62 <button type="button" class="btn btn-light  waves-effect waves-light">GÖZAT</button></td>
                                <td><i class="fas fa-gift"></i> Yatırım</td>
                                <td>Papara</td>
                                <td>20.00 TRY</td>
                                <td>0.00 TRY</td>
                                <td>20.00 TRY</td>
                                <td>2020-04-13 17:34:40</td>
                            </tr>
                            <tr>
                                <td>#62 <button type="button" class="btn btn-light  waves-effect waves-light">GÖZAT</button></td>
                                <td><i class="fas fa-gift"></i> Yatırım</td>
                                <td>Papara</td>
                                <td>20.00 TRY</td>
                                <td>0.00 TRY</td>
                                <td>20.00 TRY</td>
                                <td>2020-04-13 17:34:40</td>
                            </tr>
                            <tr>
                                <td>#62 <button type="button" class="btn btn-light  waves-effect waves-light">GÖZAT</button></td>
                                <td><i class="fas fa-gift"></i> Yatırım</td>
                                <td>Papara</td>
                                <td>20.00 TRY</td>
                                <td>0.00 TRY</td>
                                <td>20.00 TRY</td>
                                <td>2020-04-13 17:34:40</td>
                            </tr>
                            <tr>
                                <td>#62 <button type="button" class="btn btn-light  waves-effect waves-light">GÖZAT</button></td>
                                <td><i class="fas fa-gift"></i> Yatırım</td>
                                <td>Papara</td>
                                <td>20.00 TRY</td>
                                <td>0.00 TRY</td>
                                <td>20.00 TRY</td>
                                <td>2020-04-13 17:34:40</td>
                            </tr>
                            <tr>
                                <td>#62 <button type="button" class="btn btn-light  waves-effect waves-light">GÖZAT</button></td>
                                <td><i class="fas fa-gift"></i> Yatırım</td>
                                <td>Papara</td>
                                <td>20.00 TRY</td>
                                <td>0.00 TRY</td>
                                <td>20.00 TRY</td>
                                <td>2020-04-13 17:34:40</td>
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
import ContentPage from "../../../components/layout/page/contentPage";
import CardContent from "../../../components/layout/userDetail/cardContent";
export default {
name: "financialStatistics",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
