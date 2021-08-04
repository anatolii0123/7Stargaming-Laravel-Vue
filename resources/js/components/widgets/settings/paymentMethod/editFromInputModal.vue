<template>
    <b-modal id="edit-input" @ok="handleOk" title="Input Düzenle">
        <div v-if="dataForm.item">
            <b-form-group label="İnput Name">
                <b-form-input v-model="dataForm.item.name" @change="nameChance"></b-form-input>
            </b-form-group>
            <b-form-group label="İnput Placeholder">
                <b-form-input v-model="dataForm.item.placeholder"></b-form-input>
            </b-form-group>
        </div>
    </b-modal>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "editFromInputModal",
    computed:{
        ...mapGetters({
            dataForm: 'Settings/getterPaymentMethodCustomFormEdit'
        })
    },
    methods:{
        handleOk(){
            this.$emit('input-edit',this.dataForm)
        },
        nameChance(){
            this.dataForm.item.name = this.toCamelCase(this.dataForm.item.name)
        }
    }
}
</script>

<style scoped>

</style>
