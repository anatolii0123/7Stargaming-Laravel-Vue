<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="accordion custom-accordion" id="custom-accordion-one">
                    <div class="card mb-0 p-2">
                        <div class="card-header downTitle" id="headingNine">
                            <div clas="col-md-12">
                                <div class="col-md-4">
                                    <h5 class="m-0 position-relative">
                                        <a class="custom-accordion-title text-reset d-block" data-bs-toggle="collapse" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                            {{ title }}
                                        </a>
                                    </h5>
                                </div>
                                <div class="col-md-8 messageNewBut">
                                    <slot name="downButtons"></slot>
                                </div>
                            </div>
                        </div>
                        <div class="row bonusCardDetail">
                            <slot name="downContent"></slot>
                        </div>
                    </div>

                </div></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "downCardContent",
        props: ['title']
    }
</script>

<style scoped>

</style>
