<template>
    <content-page>
        <div class="row">
            <div class="col-md-12">
                <card-content title="MESAJLAR">
                    <template v-slot:buttons>
                        <button type="button" class="btn btn-success waves-effect waves-light">MESAJ GÖNDER</button>
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
        name: "messages",
        components: {CardContent, ContentPage}
    }
</script>

<style scoped>

</style>
