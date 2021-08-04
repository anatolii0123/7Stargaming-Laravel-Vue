<template>
    <b-modal id="edit-select" @ok="handleOk" title="Select Düzenle" @show="onShow" @hidden="onHidden" @cancel="onHidden">
        <div v-if="dataForm.item && modalOpen">
            <b-form-group label="Select Name">
                <b-form-input v-model="dataForm.item.name" @change="nameChance()"></b-form-input>
            </b-form-group>
            <b-form-group label="Select Placeholder" class="mt-1">
                <b-form-input v-model="dataForm.item.placeholder"></b-form-input>
            </b-form-group>
            <hr>
            <ul v-if="dataForm.item.list.length > 0" class="optionList">
                <li v-for="(option, index) in dataForm.item.list" :key="index">
                    {{ option }}
                    <b-button variant="danger" size="sm" class="btnOptionDelete" @click="dataForm.item.list.splice(index,1)"><i class="fa fa-times"></i></b-button>
                </li>
            </ul>
            <hr>
            <b-form-group label="Seçenek Ekle">
                <div class="row">
                    <div class="col-md-10">
                        <b-form-input v-model="selectOption"></b-form-input>
                    </div>
                    <div class="col-md-2">
                        <b-button variant="success" @click="addSelectOption" :disabled="selectOption.length < 3">Ekle</b-button>
                    </div>
                </div>
            </b-form-group>
        </div>
    </b-modal>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "editFormSelectModal",
    data() {
        return {
            selectOption: '',
            modalOpen: false
        }
    },
    computed:{
        ...mapGetters({
            dataForm: 'Settings/getterPaymentMethodCustomFormEdit'
        })
    },
    methods:{
        onHidden(){
            this.modalOpen = false
        },
        onShow(){
            this.modalOpen = true
        },
        handleOk(){
            this.$emit('select-edit',this.dataForm)
        },
        addSelectOption(){
            if (this.dataForm.item){
                this.dataForm.item.list.push(this.selectOption)
                this.selectOption = ''
            }
        },
        nameChance(){
            this.dataForm.item.name = this.toCamelCase(this.dataForm.item.name)
        }
    },
}
</script>

<style scoped>
.btnOptionDelete {
    float:right;
}
.optionList {
    padding:0;
}
.optionList > li {
    display: flow-root;
    padding-bottom: 5px;
}
</style>
