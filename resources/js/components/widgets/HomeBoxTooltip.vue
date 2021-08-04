<template>
    <div class="col-md-6 col-xl-3">
        <div class="card" id="tooltip-container">
            <div class="card-body">
                <i class="fa fa-info-circle text-muted float-end" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info"></i>
                <h4 class="mt-0 font-16">Income Status</h4>
                <h2 class="text-primary my-3 text-center">$<span data-plugin="counterup">31,570</span></h2>
                <p class="text-muted mb-0">Total income: $22506 <span class="float-end"><i class="fa fa-caret-up text-success me-1"></i>10.25%</span></p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "HomeBoxTooltip"
}
</script>

<style scoped>

</style>
