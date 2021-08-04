<template>
    <content-page>
        <div class="col-md-12" v-if="!loading">
            <card-content title="Social Media">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveSocialMedia"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:content>
                    <div class="row p-2">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="facebook" class="form-label">facebook</label>
                                <input type="text" v-model="facebook" id="facebook" class="form-control"
                                       placeholder="facebook">
                            </div>
                            <div class="col-md-6">
                                <label for="twitter" class="form-label">twitter</label>
                                <input type="text" v-model="twitter" id="twitter" class="form-control"
                                       placeholder="twitter">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="youtube" class="form-label">youtube</label>
                                <input type="text" v-model="youtube" id="youtube" class="form-control"
                                       placeholder="youtube">
                            </div>
                            <div class="col-md-6">
                                <label for="instagram" class="form-label">instagram</label>
                                <input type="text" v-model="instagram" id="instagram" class="form-control"
                                       placeholder="instagram">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pinterest" class="form-label">pinterest</label>
                                <input type="text" v-model="pinterest" id="pinterest" class="form-control"
                                       placeholder="pinterest">
                            </div>
                            <div class="col-md-6">
                                <label for="telegram" class="form-label">telegram</label>
                                <input type="text" v-model="telegram" id="telegram" class="form-control"
                                       placeholder="telegram">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="whatsapp" class="form-label">whatsapp</label>
                                <input type="text" v-model="whatsapp" id="whatsapp" class="form-control"
                                       placeholder="whatsapp">
                            </div>
                            <div class="col-md-6">
                                <label for="messenger" class="form-label">messenger</label>
                                <input type="text" v-model="messenger" id="messenger" class="form-control"
                                       placeholder="messenger">
                            </div>
                        </div>
                    </div>
                </template>
            </card-content>
        </div>
        <loading-spinner v-else></loading-spinner>
    </content-page>
</template>

<script>
import ContentPage from "../../components/layout/page/contentPage";
import ContentTitle from "../../components/layout/page/contentTitle";
import {mapActions, mapGetters} from "vuex";
import CardContent from "../../components/layout/userDetail/cardContent";
import LoadingSpinner from "../../components/widgets/loadingSpinner";

export default {
    name: "customCss",
    components: {LoadingSpinner, CardContent, ContentTitle, ContentPage},
    data() {
        return {
            facebook: "",
            twitter: "",
            youtube: "",
            instagram: "",
            pinterest: "",
            telegram: "",
            whatsapp: "",
            messenger: "",
            btnSaveActive: true,
            loading: true
        }
    },
    computed: {
        ...mapGetters({
            socialMedia: 'Settings/getterSocialMedia',
        })
    },
    methods: {
        ...mapActions({
            setGetSocialMedia: 'Settings/getSocialMedia',
            setUpdateSocialMedia: 'Settings/updateSocialMedia',
        }),

        getSocialMedia() {
            this.setGetSocialMedia().then(response => {
                this.facebook = this.socialMedia.facebook
                this.twitter = this.socialMedia.twitter
                this.youtube = this.socialMedia.youtube
                this.instagram = this.socialMedia.instagram
                this.pinterest = this.socialMedia.pinterest
                this.telegram = this.socialMedia.telegram
                this.whatsapp = this.socialMedia.whatsapp
                this.messenger = this.socialMedia.messenger

                this.loading = false
            })
        },
        //edit a row
        saveSocialMedia() {
            const data = {
                facebook: this.facebook,
                twitter: this.twitter,
                youtube: this.youtube,
                instagram: this.instagram,
                pinterest: this.pinterest,
                telegram: this.telegram,
                whatsapp: this.whatsapp,
                messenger: this.messenger,
            }
            // console.log(data);
            this.setUpdateSocialMedia(data).then(() => {
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                });
            });
        },

        editEventHandler() {
            if (
                this.facebook == this.socialMedia.facebook &&
                this.twitter == this.socialMedia.twitter &&
                this.youtube == this.socialMedia.youtube &&
                this.instagram == this.socialMedia.instagram &&
                this.pinterest == this.socialMedia.pinterest &&
                this.telegram == this.socialMedia.telegram &&
                this.whatsapp == this.socialMedia.whatsapp &&
                this.messenger == this.socialMedia.messenger
            ) {
                this.btnSaveActive = true
            } else {
                this.btnSaveActive = false
            }
        }

    },
    created() {
        this.getSocialMedia()
    },
    watch: {
        facebook: {
            handler: function () {
                this.editEventHandler();
            }
        },
        twitter: {
            handler: function () {
                this.editEventHandler();
            }
        },
        youtube: {
            handler: function () {
                this.editEventHandler();
            }
        },
        instagram: {
            handler: function () {
                this.editEventHandler();
            }
        },
        pinterest: {
            handler: function () {
                this.editEventHandler();
            }
        },
        telegram: {
            handler: function () {
                this.editEventHandler();
            }
        },
        whatsapp: {
            handler: function () {
                this.editEventHandler();
            }
        },
        messenger: {
            handler: function () {
                this.editEventHandler();
            }
        },
    },
}
</script>

<style scoped>

</style>
