<template>
    <!-- modal -->
    <b-modal id="multiIpAccounts" title="Accounts" hide-footer scrollable>
        <b-table :items="data" class="table-bordered">
            <template #cell(username)="data">
                <router-link :to="{ name: 'userDetail', params: {id: data.item.id} }">{{ data.item.username }}</router-link>
            </template>
        </b-table>
    </b-modal>
    <!-- modal end -->
</template>

<script>
export default {
    name: "multiIpAccountsModal",
    props:['data']
}
</script>

<style scoped>

</style>
