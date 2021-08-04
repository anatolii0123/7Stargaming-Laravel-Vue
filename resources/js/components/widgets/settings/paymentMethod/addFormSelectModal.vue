<template>
    <b-modal id="add-select" @ok="handleOk" @hidden="refreshInput" @cancel="refreshInput" :ok-disabled="okDisabled" title="Select Ekle">
        <b-form-group label="Select Name">
            <b-form-input v-model="select.name" @change="nameChance"></b-form-input>
        </b-form-group>
        <b-form-group label="Select Placeholder" class="mt-1">
            <b-form-input v-model="select.placeholder"></b-form-input>
        </b-form-group>
        <hr>
        <ul v-if="select.list.length > 0" class="optionList">
            <li v-for="(option, index) in select.list" :key="index">
                {{ option }}
                <b-button variant="danger" size="sm" class="btnOptionDelete" @click="select.list.splice(index,1)"><i class="fa fa-times"></i></b-button>
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
    </b-modal>
</template>

<script>
export default {
name: "addFormSelectModal",
    data() {
        return {
            select: {
                type: 'select',
                name: '',
                placeholder: '',
                list: []
            },
            selectOption: '',
            okDisabled: true
        }
    },
    methods:{
        handleOk(){
            this.$emit('select', this.select)
            this.refreshInput()
        },
        refreshInput(){
            this.select = {
                type: 'select',
                name: '',
                placeholder: '',
                list: []
            }
        },
        addSelectOption(){
            this.select.list.push(this.selectOption)
            this.selectOption = ''
        },
        nameChance(){
            this.select.name = this.toCamelCase(this.select.name)
        }
    },
    watch:{
        select: {
            handler: function (val){
                if (val.list.length > 0) this.okDisabled = false
            },
            deep:true
        }
    }
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
