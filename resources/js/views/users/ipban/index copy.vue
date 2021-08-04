<template>
   <content-page>
        <content-title title="IP Ban">

            <div class="col-md-1 defaultFilter dateRange">
                <p>Tarih Aralığı :</p>
            </div>
            <div class="col-md-1 defaultFilter defaultFilterDiv">
                <input data-v-0065eca5="" type="date" placeholder="Register Date"
                       class="form-control">
            </div>
            <div class="col-md-1 defaultFilter brace">-</div>
            <div class="col-md-1 defaultFilter defaultFilterDiv">
                <input data-v-0065eca5="" type="date" placeholder="Register Date"
                       class="form-control">
            </div>
            <div class="col-md-1 defaultFilter defaultFilterDiv filterButton">
                <button type="button" class="btn btn-success waves-effect waves-light">
                    <i class="fas fa-search"></i> ARA
                </button>
            </div>

        </content-title>
       <!-- header card end -->
        <table-title title="IP bans List">
            <template v-slot:table>
                tablo gelecek
            </template>
            <template v-slot:nav>
                <b-pagination></b-pagination>
            </template>
        </table-title>
   </content-page>
</template>

<script>

import ContentPage from "../../../components/layout/page/contentPage";
import ContentTitle from "../../../components/layout/page/contentTitle";
import TableTitle from "../../../components/layout/page/tableTitle";
export default {
    name: "index",
    components: {TableTitle, ContentTitle, ContentPage},
}
</script>

<style scoped>

</style>
