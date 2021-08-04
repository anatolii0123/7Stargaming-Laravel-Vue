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
            <card-content title="GEÇMİŞ">
                <template v-slot:content>
                    <div class="row casinoCardDetail p-3">
                        <div class="alert mb-0 alert-secondary bg-secondary text-white border-0" role="alert">
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
name: "slotMoves",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
