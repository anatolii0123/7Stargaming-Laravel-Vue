<template>
    <content-page>
        <div class="row">
            <div class="col-md-12">
                <card-content title="DÖKÜMAN LOGLARI">
                    <template v-slot:content>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th>Resim</th>
                                    <th>Gönderme Tarihi</th>
                                    <th>Tür</th>
                                    <th>Not</th>
                                    <th>Admin</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-light waves-effect waves-light">
                                            EVRAĞI GÖRÜNTÜLE
                                        </button>
                                    </td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>Kimlik</td>
                                    <td></td>
                                    <td>lucie</td>
                                    <td>
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            ONAYLANDI
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-light waves-effect waves-light">
                                            EVRAĞI GÖRÜNTÜLE
                                        </button>
                                    </td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>Kimlik</td>
                                    <td></td>
                                    <td>lucie</td>
                                    <td>
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            ONAYLANDI
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-light waves-effect waves-light">
                                            EVRAĞI GÖRÜNTÜLE
                                        </button>
                                    </td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>Kimlik</td>
                                    <td></td>
                                    <td>lucie</td>
                                    <td>
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            ONAYLANDI
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-light waves-effect waves-light">
                                            EVRAĞI GÖRÜNTÜLE
                                        </button>
                                    </td>
                                    <td>2020-04-13 17:34:40</td>
                                    <td>Kimlik</td>
                                    <td></td>
                                    <td>lucie</td>
                                    <td>
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            ONAYLANDI
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
        name: "documentManagement",
        components: {CardContent, ContentPage}
    }
</script>

<style scoped>

</style>
