<template>
    <b-modal id="add-input" @ok="handleOk" @hidden="refreshInput" @cancel="refreshInput" title="Input Ekle">
        <b-form-group label="İnput Name">
            <b-form-input v-model="input.name" @change=""></b-form-input>
        </b-form-group>
        <b-form-group label="İnput Placeholder">
            <b-form-input v-model="input.placeholder"></b-form-input>
        </b-form-group>
    </b-modal>
</template>

<script>
export default {
name: "addFormInputModal",
    data() {
        return {
            input: {
                type: 'input',
                name: '',
                placeholder: '',
            }
        }
    },
    methods:{
        handleOk(){
            this.$emit('input', this.input)
            this.refreshInput()
        },
        refreshInput(){
            this.input = {
                type: 'input',
                name: '',
                placeholder: '',
            }
        },
        nameChance(){
            this.input.name = this.toCamelCase(this.input.name)
        }
    }
}
</script>

<style scoped>

</style>
