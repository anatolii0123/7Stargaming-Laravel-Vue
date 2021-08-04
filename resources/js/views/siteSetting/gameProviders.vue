<template>

    <content-page>
        <div class="row">
            <div class="col-md-3">
                <card-content title="Game Providers">
                    <template v-slot:content>
                        <div class="row casinoCardDetail">

                            <button type="button" class="list-group-item list-group-item-action"
                                    :class="{active: game_type === 1}" @click="game_type = 1">Canlı Casino
                            </button>
                            <button type="button" class="list-group-item list-group-item-action"
                                    :class="{active: game_type === 0}" @click="game_type = 0">Slot
                            </button>
                            <button type="button" class="list-group-item list-group-item-action"
                                    :class="{active: game_type === 2}" @click="game_type = 2">Sanal Bahis
                            </button>
                        </div>
                    </template>
                </card-content>
            </div>
            <div class="col-md-9">
                <card-content title="Game Listing">
                    <template v-slot:buttons>
                        <!--                        <button type="button" class="btn btn-success btn-sm waves-effect waves-light"-->
                        <!--                                v-b-modal.create-payment>YENİ OLUŞTUR-->
                        <!--                        </button>-->
                    </template>
                    <template v-slot:content>
                        <div class="table-responsive"
                             v-if="!loading">
                            <b-table
                                :items="dataGameProviders.list"
                                class="table table-bordered mb-0"
                                :fields="fields"
                                responsive
                                v-if="Object.keys(dataGameProviders).length > 0"
                            >
                                <template #cell(logo)="data">
                                   <img :src="data.item.logo" v-show="data.item.logo" height="35" width="160">
                                </template>

                                <template #cell(status)="data">
                                    <button class="btn btn-danger btn-sm" v-if="data.item.status == 0"
                                            @click="updateGameStatus(data, 1, $event)">Pasif
                                    </button>
                                    <button class="btn btn-success btn-sm" v-if="data.item.status == 1"
                                            @click="updateGameStatus(data, 0, $event)">Aktif
                                    </button>
                                </template>
                            </b-table>
                            <no-data v-if="Object.keys(dataGameProviders.list).length <= 0">
                                Bu site için ödeme yöntemi bulunamadı.
                            </no-data>
                        </div>
                        <loading-spinner v-else></loading-spinner>


                    </template>
                </card-content>
            </div>
        </div>
    </content-page>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ContentPage from "../../components/layout/page/contentPage";
import CardContent from "../../components/layout/userDetail/cardContent";
import LoadingSpinner from "../../components/widgets/loadingSpinner";

export default {
    name: "gameProviders",
    components: {LoadingSpinner, CardContent, ContentPage},
    data() {
        return {
            loading: true,
            game_type: 0,
            fields: [
                {
                    key: 'name',
                    label: 'Name'
                },
                {
                    key: 'logo',
                },
                {
                    key: 'status',
                    label: ''
                }
            ]
        }
    },
    computed:{
        ...mapGetters({
            dataGameProviders: 'Settings/getterGameProviders'
        })
    },
    methods: {
        ...mapActions({
            getGameProvidersAction: 'Settings/getGameProviders',
            setGameProviderStatus: 'Settings/setGameProviderStatus'
        }),
        getGameProviders() {
            this.loading = true
            this.getGameProvidersAction({
                type: this.game_type
            }).then(() => {
                this.loading = false
            }).catch(() => {
                this.loading = false
            })
        },
        updateGameStatus (data, status, event){
            event.preventDefault()
            event.target.disabled = true
            this.setGameProviderStatus({
                code: data.item.code,
                status: status,
                type: data.item.type
            }).then(() => {
                this.dataGameProviders.list[data.index].status = status
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Success'
                })
                event.target.disabled = false
            }).catch(() => {
                this.$notify({
                    group: 'foo',
                    type: 'danger',
                    title: 'error',
                    text: 'Error'
                });
            })
        }
    },
    watch: {
        game_type: {
            handler: function () {
                this.getGameProviders()
            }
        }
    },
    created() {
        this.getGameProviders()
    }
}
</script>

<style scoped>

</style>
