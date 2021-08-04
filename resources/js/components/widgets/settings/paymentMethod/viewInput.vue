<template>
    <b-form-group :label="item.name">
        <div class="row">
            <div class="col-md-10">
                <b-form-input type="text" :placeholder="item.placeholder"></b-form-input>
            </div>
            <div class="col-md-2 text-center">
                <b-button variant="success" @click="inputEdit"><i class="fa fa-pencil-alt"></i></b-button>
                <b-button variant="danger" @click="$emit('delete-form-item', index)"><i class="fa fa-times"></i>
                </b-button>
            </div>
        </div>
    </b-form-group>
</template>

<script>
export default {
    name: "viewInput",
    props: ['item', 'index'],
    methods:{
        inputEdit(){
            this.$store.commit('Settings/SET_PAYMENT_METHOD_CUSTOM_FORM_EDIT',{
                item: this.item,
                index: this.index
            })
            this.$bvModal.show('edit-input')
        }
    }
}
</script>

<style scoped>

</style>
