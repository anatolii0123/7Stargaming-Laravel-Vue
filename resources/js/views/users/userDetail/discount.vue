<template>
    <content-page>
        <div class="col-md-4">
            <card-content title="DISCOUNT">
                <template v-slot:content>
                    <div class="row discountCard">
                        <div class="col-md-12">
                            <div class="form-check mb-2 form-check-success">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customradio1" checked="">
                                <label class="form-check-label" for="customradio1">Yatırım / Çekim Formuna Göre</label>
                            </div>

                            <div class="form-check mb-2 form-check-success">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customradio2">
                                <label class="form-check-label" for="customradio2">Canlı Casino Farkına Göre</label>
                            </div>

                            <div class="form-check mb-2 form-check-success">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customradio3">
                                <label class="form-check-label" for="customradio3">Slot Farkına Göre</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="example-date" class="form-label">Tarih</label>
                                <input class="form-control" id="example-date" type="date" name="date">
                            </div>
                            <div class="mb-3">
                                <label for="example-palaceholder" class="form-label">Bonuslu Yatırımlar Dahil Edilsin mi ?</label>
                                <div class="dpFle oneSet">
                                <div class="form-check mb-2 form-check-success">
                                    <input class="form-check-input" type="radio" name="radioEdit" id="radio1">
                                    <label class="form-check-label" for="radio1">Evet</label>
                                </div>
                                <div class="form-check mb-2 form-check-success">
                                    <input class="form-check-input" type="radio" name="radioEdit" id="radio2">
                                    <label class="form-check-label" for="radio2">Hayır</label>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="example-palaceholder" class="form-label">Discount Yüzdesi</label>
                                <input type="text" id="example-palaceholder" class="form-control" placeholder="Discount Yüzdesi">
                            </div>
                            <div class="mb-3">
                                <label for="example-palaceholder" class="form-label">Kredi Kartı Yüzdesi dahil edilsin mi ?</label>
                                <div class="dpFle oneSet">
                                    <div class="form-check mb-2 form-check-success">
                                        <input class="form-check-input" type="radio" name="radioEdit" id="radio1">
                                        <label class="form-check-label" for="radio1">Evet</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-success">
                                        <input class="form-check-input" type="radio" name="radioEdit" id="radio2">
                                        <label class="form-check-label" for="radio2">Hayır</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                SORGULA
                            </button>
                        </div>


                    </div>

                </template>

            </card-content>
        </div>
        <div class="col-md-8">
            <card-content title="DISCOUNT GEÇMİŞİ">
                <template v-slot:content>
                    <div class="row casinoCardDetail p-3">
                    <div role="alert" class="alert mb-0 alert-secondary bg-secondary text-white border-0">
                    Maalesef veri bulunamadı.
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
name: "discount",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
