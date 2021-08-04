<template>
    <div class="col-md-4">
        <div class="card">
            <div id="chartTitle" class="col-md-12">
                <p>{{ this.item.title }}</p>
                <button v-on:click = "changeTerm('monthly')" class = "btn btn-primary buttonDay" :class='{active : !isActive }'>Monthly</button>
                <button v-on:click = "changeTerm('daily')" class = "btn btn-primary buttonDay" :class='{active : isActive }'>Daily</button>
            </div>
            <div class="card-body">
                <div class="card-widgets">
                    <b-button v-if="showProfitableButton" :disabled="this.disableProfitableButton" v-b-modal="item.type" variant="primary">Profitable Games</b-button>
                    <b-modal centered  :id="item.type" size="lg" title="Profitable Games" :hide-footer="true">
                        <div id="chart">
                            <apexchart type="bar" height="350" :options="gameChartOptions" :series="gameSeries"></apexchart>
                        </div>
                    </b-modal>
                </div>
                <div id="chart" style="margin-top:50px; margin-left:70px; height:350px">
                    <apexchart type="pie" :options="profitChartOptions" :series="profitSeries"></apexchart>
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</template>

<script>
import numeral from 'numeral'
export default {
    name: "StatisticsProfitCard",
    props:[
        'item', 'currency'
        ],
    components: {
    },
    data(){
        return{
            isActive:true,
            showProfitableButton:true,
            disableProfitableButton:false,
            gameSeries: [{
                data: []
            }],
            gameChartOptions: {
                xaxis: {
                    categories: [],
                },
                plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            },
            profitSeries: [0, 0, 0],
            profitChartOptions: {
                chart: {
                    width: 380,
                    type: 'pie',
                },
                legend: {
                    position: 'bottom',
                    fontSize: '12px',
                    fontWeight: 200,

                },
                labels: [],
                noData: {
                    text: "No Data",
                    align: 'center',
                    verticalAlign: 'top',
                    style: {
                        color: undefined,
                        fontSize: '14px',
                        fontFamily: undefined
                    }
                }
            },
        }
    },
    computed:{
    },
    methods: {
        changeTerm(msg){
            if(this.item.type == "coupon"){
                this.showProfitableButton = false;
            }else{
                this.showProfitableButton = true;
            }

            if(msg == "daily"){
                this.isActive = true;

                this.initProfitChart(this.item.daily);
                let temp1 = [];
                let temp2 = [];
                if(typeof this.item.daily.games !== "undefined")
                {
                    if(this.item.daily.games.length !== 0){
                        this.disableProfitableButton = false;
                        this.item.daily.games.forEach((value, index) => {
                            temp1.push(value.name);
                            temp2.push(value.amount);
                        });
                        this.initGameChart(temp1, temp2);
                    }else{
                        this.disableProfitableButton = true;
                        this.initGameChart([], []);
                    }
                }else{
                    this.disableProfitableButton = true;
                    this.initGameChart([], []);
                }

            }else{
                this.isActive = false;

                this.initProfitChart(this.item.monthly);

                let temp1 = [];
                let temp2 = [];

                if(typeof this.item.monthly.games !== "undefined")
                {
                    if(this.item.monthly.games.length !== 0){
                        this.disableProfitableButton = false;
                        this.item.monthly.games.forEach((value, index) => {
                            temp1.push(value.name);
                            temp2.push(value.amount);
                        });
                        this.initGameChart(temp1, temp2);
                    }else{
                        this.disableProfitableButton = true;
                        this.initGameChart([], []);
                    }
                }else{
                    this.disableProfitableButton = true;
                    this.initGameChart([], []);
                }

            }
        },
        initGameChart(temp1, temp2){
            this.gameChartOptions = {
                xaxis: {
                    categories: temp1,
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                }
            };
            this.gameSeries = [{data:temp2}];
        },
        initProfitChart(data){
            if(data.profit == 0 && data.win == 0 && data.bet == 0){
                this.profitSeries = [];
                this.profitChartOptions={
                    labels: [],
                    noData: {
                        text: "No Data",
                        align: 'center',
                        verticalAlign: 'top',
                        style: {
                            color: undefined,
                            fontSize: '14px',
                            fontFamily: undefined
                        }
                    }
                }
            }else{
                this.profitSeries = [data.profit, data.win, data.bet];
                this.profitChartOptions={
                    chart: {
                        width: '50%',
                        type: 'pie',
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '12px',
                        fontWeight: 200,
                    },
                    labels: [
                        "Profit " + data.profit + ' ' + this.currency,
                        "Win " + data.win + ' ' + this.currency,
                        "Bet " + data.bet + ' ' + this.currency
                    ],
                    dataLabels:{
                        formatter: function (val){
                            return numeral(val).format('0.00') + '%'
                        },
                        style: {
                            fontSize: '14px',
                            fontFamily: 'Helvetica, Arial, sans-serif',
                            fontWeight: 'bold',
                            colors: ['#fff','#fff', '#fff']
                        },
                    },
                    noData: {
                        text: "No Data",
                        align: 'center',
                        verticalAlign: 'top',
                        style: {
                            color: undefined,
                            fontSize: '14px',
                            fontFamily: undefined
                        }
                    }
                }
            }
        }
    },
    created(){
        this.changeTerm("daily");
    }
}
</script>

<style scoped>

</style>
