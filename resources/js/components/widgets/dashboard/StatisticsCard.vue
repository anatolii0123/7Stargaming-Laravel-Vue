<template>
    <div class="col-md-2">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="text-end">
                            <p class="text-muted newClass mb-1 text-truncate">
                                {{ this.title }}
                            </p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <p class="memNumber">
                                {{ this.memNumber }}
                            </p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="avatarLgNew">
                            <i :style="colorSet" :class="this.icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "StatisticsCard",
        props: ['icon', 'memNumber', 'title', 'color'],
        computed: {
            colorSet() {
                return 'color : ' + this.color
            }
        }
    }
</script>

<style scoped>

</style>
