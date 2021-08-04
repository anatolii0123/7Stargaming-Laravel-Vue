<template>
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i :class="iconSet"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ randomNumber }}</span></h3>
                            <p class="text-muted mb-1 text-truncate"><slot></slot></p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</template>

<script>
export default {
    name: "HomeBoxCircle",
    props:['icon'],
    computed:{
        iconSet(){
            return this.icon + ' font-22 avatar-title text-primary'
        },
        randomNumber(){
            return Math.floor(Math.random() * 10000) + 3000
        }
    }
}
</script>

<style scoped>

</style>
