<template>
    <div>
        <div class="col-md-8 usRight" v-if="groupActive">
            <div class="userGroupRightBody">
                <div class="col-md-12 userGroupListTitle">
                    <div class="col-md-4 userGroupTitle">
                        <h5 v-if="groupActive.name">GRUP ADI : {{ groupActive.name }}</h5>
                        <h5 v-else="groupActive.name">GRUP ADI : Yeni Kayıt</h5>
                    </div>
                </div>
            </div>
            <div class="userGroupDetails">

                <div class="row pdB20">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inputPassword4" class="form-label">Üye Grubunun Adı</label>
                            <input type="text" class="form-control" v-model="groupActive.name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputPassword4" class="form-label">Not</label>
                            <input type="text" class="form-control" v-model="groupActive.note">
                        </div>
                    </div>
                    <div class="col-md-12 colorSelector pdB20">
                        <label class="form-label">Renk Seçiniz {{ groupActive.color }}</label><br>
                        <div class="btn-group" data-toggle="buttons">
                            <label
                                v-for="color in colors"
                                 class="btn "
                                 :style="{backgroundColor: color}"
                                :class="{active: colorCheckedActive(color)}"
                            >
                                <input type="radio" v-model="groupActive.color" :value="color">
                                <span class="mdi mdi-progress-check"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 iconSelector">
                        <label class="form-label">Icon Seçiniz</label><br>
                        <div class="iconGroup" data-toggle="buttons">
                            <ul>
                                <li v-for="icon in icons" @click="setSelectedIcon(icon)" class="icons">
                                    <span><i :class="iconActiveSet(icon)"></i></span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="userGroupCardBody pdB20">
                            <div class="col-md-12 userGroupListTitle">
                                <div class="col-md-4 userGroupCardTitle">
                                    <h5>PARA YATIRIM İZİNLERİ</h5>
                                </div>
                                <div class="col-md-8 userGroupSorting">
                                    <input type="checkbox" checked="" data-plugin="switchery" data-color="#1bb99a"
                                           style="display: none;" data-switchery="true">
                                    <span class="switchery switchery-default"
                                          style="background-color: rgb(27, 185, 154); border-color: rgb(27, 185, 154); box-shadow: rgb(27, 185, 154) 0px 0px 0px 16.5px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small
                                        style="left: 19px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);"></small></span>
                                    <a href="#"><i class="mdi mdi-information"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPassword4" class="form-label">Son yatırıma kaç katı ödeme yapıyorsunuz
                                ?</label>
                            <select class="form-select" v-model="groupActive.deposit_floor">
                                <option value="0">Hepsi</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPassword4" class="form-label">Discount bakiyesi varken yatırım izni</label>
                            <select class="form-select" v-model="groupActive.deposit_discount_access">
                                <option value="1">Evet</option>
                                <option value="0">Hayır</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="userGroupCardBody pdB20">
                            <div class="col-md-12 userGroupListTitle">
                                <div class="col-md-4 userGroupCardTitle">
                                    <h5>PARA ÇEKİM İZİNLERİ</h5>
                                </div>
                                <div class="col-md-8 userGroupSorting">
                                    <input type="checkbox" checked="" data-plugin="switchery" data-color="#1bb99a"
                                           style="display: none;" data-switchery="true">
                                    <span class="switchery switchery-default"
                                          style="background-color: rgb(27, 185, 154); border-color: rgb(27, 185, 154); box-shadow: rgb(27, 185, 154) 0px 0px 0px 16.5px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small
                                        style="left: 19px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);"></small></span>
                                    <a href="#"><i class="mdi mdi-information"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPassword4" class="form-label">Günlük limit ne kadar ?</label>
                            <input type="text" class="form-control" id="inputPassword4"
                                   v-model="groupActive.withdraw_amount">

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPassword4" class="form-label">Çekimde bakiyeden discount tutarını
                                al</label>
                            <select class="form-select" v-model="groupActive.withdraw_discount_remove">
                                <option value="1">Evet</option>
                                <option value="0">Hayır</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="userGroupCardBody pdB20">
                            <div class="col-md-12 userGroupListTitle">
                                <div class="col-md-4 userGroupCardTitle">
                                    <h5>DISCOUNT AYARLARI</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPassword4" class="form-label">Discount kaç gün geçerli olsun ?</label>
                            <select class="form-select" v-model="groupActive.discount_day">
                                <option>Süresiz</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="365">365</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="inputPassword4" class="form-label">Discount tutarının kaç katını ödüyorsunuz
                                ?</label>
                            <select class="form-select" v-model="groupActive.discount_floor">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ugDelSav">
                    <button type="submit" class="btn btn-success waves-effect waves-light" @click.prevent="submit" :disabled="submitButton">
                        KAYDET
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light"
                            @click="deleteGroup(groupActive.id)" v-show="editing">SİL
                    </button>
                </div>
            </div>

        </div>
        <div v-else>
            <div class="col-md-8 usRight">
                <div class="userGroupRightBody">
                    <div class="col-md-12 userGroupListTitle">
                        <div class="col-md-4 userGroupTitle">
                            <h5>Grup YOK! </h5>
                        </div>
                    </div>
                </div>
                <div class="userGroupDetails">
                    <div class="row">
                        <div class="alert alert-dark bg-dark text-light border-0 mb-0 alertUserGroup" role="alert">
                            <i class="mdi mdi-information"></i> Bu site için henüz grup eklenmemiş.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "groupDetail",
    data() {
        return {
            submitButton: false,
            icons: [
                'fas fa-user',
                'fas fa-users',
                'fas fa-ban',
                'fas fa-landmark',
                'fas fa-bolt',
                'fas fa-bug',
                'fas fa-gift',
                'fas fa-rocket',
                'fas fa-walking',
                'fas fa-bullhorn',
                'fas fa-coffee',
                'fas fa-eye',
                'fas fa-gamepad',
                'fas fa-globe-europe',
                'fas fa-heart',
                'fas fa-leaf',
                'fas fa-home',
                'fas fa-thumbs-down',
                'fas fa-thumbs-up',
                'fas fa-futbol',
                'fab fa-twitter',
                'fab fa-facebook-f',
            ],
            colors: [
                '#14d8b2',
                '#15967d',
                '#3f9eb4',
                '#4fc6e1',
                '#dedede',
                '#b54051',
            ],
            editing: false,
            groupDataDefault: {
                name: '',
                color: '',
                icon: '',
                deposit_floor: '',
                deposit_dicount_access: '',
                withdraw_amount: '',
                withdraw_discount_remove: '',
                discount_day: '',
                discount_floor: '',
                note: ''
            },
            groupActive: {}
        }
    },
    props: ['dataG'],
    computed:{
        ...mapGetters({
            groups: 'UserManagement/groups'
        })
    },
    methods: {
        ...mapActions({
            setUpdateGroup: 'UserManagement/updateGroup',
            setCreateGroup: 'UserManagement/createGroup',
            setDeleteGroup: 'UserManagement/deleteGroup'
        }),
        colorCheckedActive(color) {
            if (this.groupActive.color === color){
                return true
            }
            return false
        },
        iconActiveSet(icon) {
            let i = icon
            if (this.groupActive && i === this.groupActive.icon) {
                i += ' active'
            }
            return i
        },

        setSelectedIcon(icon) {
            this.groupActive.icon = icon
        },
        updateGroup() {
            this.submitButton = true
            this.setUpdateGroup({
                id: this.groupActive.id,
                data: this.groupActive
            }).then(() => {
                this.submitButton = false
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Grup başarı ile güncellendi'
                });

            }).catch(error => {
                this.submitButton = false
                if (error) {
                    error = Object.values(error)
                    error.forEach(item => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Error',
                            text: item[0]
                        });
                    })
                }
            })
        },
        createGroup() {
            this.submitButton = true
            this.setCreateGroup(this.groupActive).then(() => {
                this.groups.push(this.groupActive)
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Grup başarı ile eklendi'
                });
                this.groupActive =  _.cloneDeep(this.groupDataDefault)
                this.submitButton = false
            }).catch(error => {
                this.submitButton = false
                if (error) {
                    error = Object.values(error)
                    error.forEach(item => {
                        this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Error',
                            text: item[0]
                        });
                    })
                }
            })
        },

        submit() {
            if (this.editing) {
                this.updateGroup()
            } else {
                this.createGroup()
            }
        },
        deleteGroup(id) {
            this.setDeleteGroup(id).then(() => {
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Success',
                    text: 'Grup başarı ile silindi'
                });

            })
        }

    },
    watch: {
        dataG: function (val) {
            if (val !== null) {
                this.groupActive = _.cloneDeep(val)
                this.editing = true
            } else {
                this.editing = false
                this.groupActive = _.cloneDeep(this.groupDataDefault)
            }
        }
    },
    created() {
        this.groupActive =  _.cloneDeep(this.groupDataDefault)
    },
    mounted() {
        this.groupActive = _.cloneDeep(this.dataG)
        this.editing = true
    }
}
</script>

<style scoped>
    .icons  {
        padding-right: 5px !important;
    }
</style>
