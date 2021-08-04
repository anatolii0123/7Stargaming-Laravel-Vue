<template>
    <content-page>
        <div class="col-md-4">
            <card-content title="ÜYE BİLGİLERİ">
                <template v-slot:content>
                    <div class="row m-0 userCardUpdate">
                        <div class="col-md-12">
                            <div class="dpFle">
                                <div class="col-md-4">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">İsim</label>
                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="İsim">
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Soyisim</label>
                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="Soyisim">
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">TC Kimlik</label>
                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="TC Kimlik">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dpFle">
                                <div class="col-md-4">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Doğum Tarihi</label>
                                    <input class="form-control" id="example-date" type="date" name="date">
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Cinsiyet</label>
                                    <select class="form-select">
                                        <option selected="">Erkek</option>
                                        <option value="1">Kadın</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Para Birimi</label>
                                    <select class="form-select">
                                        <option selected="">TRY</option>
                                        <option value="1">GBP</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success waves-effect waves-light">
                                    GÜNCELLE
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-4">
            <card-content title="ÜYE İLETİŞİM BİLGİLERİ">
                <template v-slot:content>
                    <div class="row m-0 userCardUpdate">
                        <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="userUpdate mb-2">
                                        <label for="example-palaceholder" class="form-label">E-Posta</label>
                                        <input type="text" id="example-palaceholder" class="form-control" placeholder="E-Posta Adresi">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="userUpdate ">
                                    <label for="example-palaceholder" class="form-label">Telefon</label>
                                </div>
                                <div class="col-md-12 btnW100">
                                <button type="button" class="btn btn-light waves-effect waves-light">
                                    GÖSTER
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-4">
            <card-content title="ÜYE ADRES BİLGİLERİ">
                <template v-slot:content>
                    <div class="row m-0 userCardUpdate">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Ülke</label>
                                    <select class="form-select">
                                        <option selected="">Turkey</option>
                                        <option value="1">Germany</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Şehir</label>
                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="Eksik Veri">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="userUpdate mb-2">
                                    <label for="example-palaceholder" class="form-label">Adres</label>
                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="Eksik Veri">
                                </div>
                            </div>
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
    name: "informationUpdate",
    components: {CardContent, ContentPage}
}
</script>

<style scoped>

</style>
