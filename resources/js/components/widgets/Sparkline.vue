<template>
    <div class="col-xl-4" :class="setId">
        <div class="card">
            <div class="card-body">
                <div class="card-widgets">
                    <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                    <a data-bs-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false"
                       aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                </div>
                <h4 class="header-title mb-0"><slot></slot></h4>

                <div id="cardCollpase3" class="collapse pt-3 show">
                    <div class="text-center">
                        <div :id="setId" data-colors="#00acc1,#4b88e4,#e3eaef,#fd7e14"></div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>18k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                <h4><i class="fe-arrow-up text-success me-1"></i>3.25k</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                                <h4><i class="fe-arrow-up text-success me-1"></i>28k</h4>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div> <!-- collapsed end -->
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</template>

<script>

export default {
    name: "Sparkline",
    props:['id', 'values'],
    computed:{
        setId(){
            if (this.id){
                return this.id
            }
            return 'total-users'
        }
    },
    mounted() {
        const e = ["#00acc1", "#4b88e4", "#e3eaef", "#fd7e14"]
        // $("#slot-kar").hide()
        // $(".slot-kar").hide()
        $('#' + this.setId).sparkline(this.values, {
            type: "pie",
            width: "220",
            height: "220",
            sliceColors: e
        })
    }
}
</script>

<style scoped>

</style>
