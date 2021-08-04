<template>
    <div class="card">
        <div class="card-body">
            <div class="accordion custom-accordion" id="custom-accordion-one">
                <div class="card mb-0">
                    <div class="card-header userFilter" id="headingNine">
                        <h5 class="m-0 position-relative">
                            <a class="custom-accordion-title text-reset d-block"
                               data-bs-toggle="collapse" href="#collapseNine" aria-expanded="true"
                               aria-controls="collapseNine">
                                {{ title }}<i class="mdi mdi-chevron-down accordion-arrow"></i>
                            </a>
                        </h5>
                    </div>
                    <div class="row filterGroupDefault">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "contentTitle",
    props:['title']
}
</script>

<style scoped>

</style>
