<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    <div class="card mb-0">
                        <div class="card-header userFilter" id="headingNine">
                            <div clas="col-md-12">
                                <div class="col-md-4">
                                    <h5 class="m-0 position-relative">
                                        <a class="custom-accordion-title text-reset d-block" data-bs-toggle="collapse" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                            {{ title }}
                                        </a>
                                    </h5>
                                </div>
                                <div class="col-md-8 messageNewBut">
                                    <slot name="buttons"></slot>
                                </div>
                                <div class="col-md-8 depositSorting">
                                    <slot name="sortButtons"></slot>
                                </div>
                            </div>
                        </div>
                        <div class="row bonusCardDetail">
                           <slot name="content"></slot>
                        </div>
                        <div class="row generalCardDetail">
                            <slot name="generalContent"></slot>
                        </div>
                    </div>

                </div></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "cardContent",
        props:['title']
    }
</script>

<style scoped>

</style>
