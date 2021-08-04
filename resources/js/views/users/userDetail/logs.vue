<template>
    <content-page>
        <div class="col-md-4">
            <card-content title="BÖLÜMLER">
                <template v-slot:content>
                <div class="row m-0 ">
                    <div class="col-md-12 p-0 ">
                    <button type="button" class="list-group-item list-group-item-action active">Giriş Logları</button>
                    <button type="button" class="list-group-item list-group-item-action">Güncelleme Logları</button>
                    <button type="button" class="list-group-item list-group-item-action">Admin Logları</button>
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

          <div class="col-md-12">
            <card-content title="ADMIN LOGLARI">
               <template v-slot:content>
                   <div class="table-responsive">
                       <table class="table table-bordered mb-0">
                           <thead>
                           <tr>
                               <th>ID</th>
                               <th>İşlem</th>
                               <th>IP</th>
                               <th>Tarih</th>
                           </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td>#9159</td>
                               <td>Kullanıcı Kayıt Oldu</td>
                               <td>127.0.0.1</td>
                               <td>2020-04-13 17:34:40</td>
                           </tr>
                           <tr>
                               <td>#9159</td>
                               <td>Kullanıcı Kayıt Oldu</td>
                               <td>127.0.0.1</td>
                               <td>2020-04-13 17:34:40</td>
                           </tr>
                           <tr>
                               <td>#9159</td>
                               <td>Kullanıcı Kayıt Oldu</td>
                               <td>127.0.0.1</td>
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
name: "logs",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
