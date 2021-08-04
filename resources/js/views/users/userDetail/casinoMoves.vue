<template>
    <content-page>
        <div class="col-md-4">
            <card-content title="GÜNLÜK RAPORLAR">
                <template v-slot:content>
                    <div class="row casinoCardDetail p-3">
                        <div class="alert mb-0 alert-secondary bg-secondary text-white border-0" role="alert">
                            Maalesef veri bulunamadı.
                        </div>
                    </div>
                </template>
            </card-content>
            <card-content title="SAĞLAYICILAR">
                <template v-slot:content>
                    <div class="row casinoCardDetail">
                        <button type="button" class="list-group-item list-group-item-action active">Hepsi</button>
                        <button type="button" class="list-group-item list-group-item-action">Evolution Gaming</button>
                        <button type="button" class="list-group-item list-group-item-action">Netent Gaming</button>
                        <button type="button" class="list-group-item list-group-item-action">Authentic Gaming</button>
                        <button type="button" class="list-group-item list-group-item-action">Xpor Gaming</button>
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
name: "casinoMoves",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
