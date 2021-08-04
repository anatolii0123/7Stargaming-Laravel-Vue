<template>
    <div class="col-md-4">
        <div class="widget-rounded-circle card">
            <div class="card-body" style="height:170px;">
                <div class="row">
                    <div id="buttonTag" class="col-12">
                        <div class="text-end">
                            <p class="text-muted newClass mb-1 text-truncate">{{ cardInfo.title }}</p>
                            <b-button v-if="this.dealMethods.length > 0" v-b-modal="cardInfo.type" variant="primary">Detail</b-button>
                            <b-modal centered :id="cardInfo.type" :title="cardInfo.title" :hide-footer="true">
                                <div style="padding-bottom : 20px">
                                    <div
                                        v-for=" deal in this.dealMethods"
                                        :key="deal.id"
                                        style="padding-top:10px; padding-bottom:10px; font-weight:bold; background-color:#e6e6e6; color: #040404; line-height: 1.5em; font-size : 15px;margin-bottom: 5px"
                                    >
                                        <span style="margin-left:30px">{{ deal.name }}</span>
                                        <span style="float:right; margin-right:30px">{{ deal.amount | numFormat('0.00') }} {{ currency }}</span>
                                    </div>
                                </div>
                            </b-modal>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="text-end">
                            <p class="memNumberUnit">{{  currency }}</p>
                            <p class="memNumberStat">{{ cardInfo.data.amount | numFormat('0.00') }}</p>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="avatarLgNew">
                            <i :style="'color : '+ cardInfo.miniBtnColor" :class="cardInfo.miniBtnClass"></i>
                        </div>
                    </div>
                    <div class="col-12" style="padding-top:30px;">
                        <div class="text-end">
                            <p style="float:left;">Toplam Yatırım Adedi</p>
                            <p style="float:right;">{{ setPiece }}</p>
                        </div>
                    </div>

                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</template>

<script>

export default {
    name: "StatisticsDepositCard",
    props:[
        'cardInfo', 'currency'
        ],
    data(){
        return{
            dealMethods : []
        }
    },
    computed:{
        setPiece(){
            return this.cardInfo.data.piece + " " + "Adet"
        }
    },
    methods:{
        initDealMethods(){
            let i = 0;
            this.cardInfo.data.methods.forEach(element => {
                element.id = i;
                this.dealMethods.push(element);
                i++;
            });
        }
    },
    created(){
        this.initDealMethods();
    }
}
</script>

<style scoped>

</style>
