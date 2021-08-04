<template>
    <content-page>
        <div class="col-md-6" v-if="!loading">
            <card-content title="Web">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveCustomCSS"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:content>
                    <div class="col-md-12">
                        <textarea class="form-control" v-model="web" cols="100" rows="10"></textarea>
                    </div>
                </template>
            </card-content>
        </div>
        <div class="col-md-6" v-if="!loading">
            <card-content title="Mobile">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveCustomCSS"
                            class="btn btn-success btn-sm waves-effect waves-light">
                        Save
                    </button>
                </template>
                <template v-slot:content>
                    <div class="col-md-12">
                        <textarea class="form-control" v-model="mobile" cols="100" rows="10"></textarea>
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
            web: "",
            mobile: "",
            btnSaveActive: true,
            loading: true
        }
    },
    computed: {
        ...mapGetters({
            customCSS: 'Settings/getterCustomCSS',
        })
    },
    methods: {
        ...mapActions({
            setGetCustomCSS: 'Settings/getCustomCSS',
            setUpdateCustomCSS: 'Settings/updateCustomCSS',
        }),
        getCustomCSS() {
            this.setGetCustomCSS().then(response => {
                this.web = this.customCSS.web
                this.mobile = this.customCSS.mobile
                this.loading = false
            })
        },
        saveCustomCSS(){
            this.setUpdateCustomCSS({web:this.web, mobile:this.mobile}).then(() => {
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                });
            });
        },
        editEventHandler(){
            if(this.web == this.customCSS.web && this.mobile == this.customCSS.mobile){
                this.btnSaveActive = true
            }else{
                this.btnSaveActive = false
            }
        }
    },
    created() {
        this.getCustomCSS()
    },
    watch: {
        web: {
            handler: function () {
                this.editEventHandler();
            }
        },
        mobile: {
            handler: function () {
                this.editEventHandler();
            }
        },
    },
}
</script>

<style scoped>

</style>
