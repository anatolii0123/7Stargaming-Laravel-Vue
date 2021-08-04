<template>
    <content-page>
        <div class="col-md-6" v-if="!loading">
            <card-content title="Web">
                <template v-slot:buttons>
                    <button type="button"
                            :disabled="btnSaveActive"
                            @click="saveCustomJS"
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
                            @click="saveCustomJS"
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
    name: "customJavaScript",
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
            customJS: 'Settings/getterCustomJS',
        })
    },
    methods: {
        ...mapActions({
            setGetCustomJS: 'Settings/getCustomJS',
            setUpdateCustomJS: 'Settings/updateCustomJS',
        }),
        getCustomJS() {
            this.setGetCustomJS().then(response => {
                this.web = this.customJS.web
                this.mobile = this.customJS.mobile
                this.loading = false
            })
        },
        saveCustomJS(){
            this.setUpdateCustomJS({web:this.web, mobile:this.mobile}).then(() => {
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Succes'
                });
            });
        },
        editEventHandler(){
            if(this.web == this.customJS.web && this.mobile == this.customJS.mobile){
                this.btnSaveActive = true
            }else{
                this.btnSaveActive = false
            }
        }
    },
    created() {
        this.getCustomJS()
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
