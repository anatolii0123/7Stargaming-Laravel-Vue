<template>
    <b-form-group :label="item.name">
        <div class="row">
            <div class="col-md-10">
                <b-form-select :options="item.list" class="form-select"></b-form-select>
            </div>
            <div class="col-md-2 text-center">
                <b-button variant="success" @click="selectEdit"><i class="fa fa-pencil-alt"></i></b-button>
                <b-button variant="danger" @click="$emit('delete-form-item', index)"><i class="fa fa-times"></i></b-button>
            </div>
        </div>
    </b-form-group>
</template>

<script>
export default {
    name: "viewSelect",
    props: ['item', 'index'],
    methods:{
        selectEdit(){
            this.$store.commit('Settings/SET_PAYMENT_METHOD_CUSTOM_FORM_EDIT',{
                item: this.item,
                index: this.index
            })
            this.$bvModal.show('edit-select')
        }
    }
}
</script>

<style scoped>

</style>
