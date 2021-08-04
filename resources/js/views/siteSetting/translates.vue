<template>
    <content-page>
        <div class="col-md-3">
            <card-content title="YÖNTEMLER">
                <template v-slot:content>
                    <div class="row casinoCardDetail">
                        <button type="button" class="list-group-item list-group-item-action active">Hepsi</button>
                        <button type="button" class="list-group-item list-group-item-action">Yatırım Yöntemleri</button>
                        <button type="button" class="list-group-item list-group-item-action">Çekim Yöntemleri</button>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-9">
            <card-content title="ÖDEME YÖNTEMLERİ">
                <template v-slot:buttons>
                    <button type="button" class="btn btn-success btn-sm waves-effect waves-light">YENİ OLUŞTUR</button>
                </template>
                <template v-slot:content>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Yollayan</th>
                                <th>Departman</th>
                                <th>IP</th>
                                <th>Tarih</th>
                                <th>Durumu</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>#2855</td>
                                <td>Sistem</td>
                                <td>Diğer Konular</td>
                                <td>127.0.0.1</td>
                                <td>2020-04-13 17:34:40</td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">
                                        KAPALI
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#2855</td>
                                <td>Sistem</td>
                                <td>Diğer Konular</td>
                                <td>127.0.0.1</td>
                                <td>2020-04-13 17:34:40</td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">
                                        KAPALI
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#2855</td>
                                <td>Sistem</td>
                                <td>Diğer Konular</td>
                                <td>127.0.0.1</td>
                                <td>2020-04-13 17:34:40</td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">
                                        KAPALI
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#2855</td>
                                <td>Sistem</td>
                                <td>Diğer Konular</td>
                                <td>127.0.0.1</td>
                                <td>2020-04-13 17:34:40</td>
                                <td>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">
                                        KAPALI
                                    </button>
                                </td>
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
    name: "translates",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
