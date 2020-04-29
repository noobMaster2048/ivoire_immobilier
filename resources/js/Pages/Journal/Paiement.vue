<template>
    <div class="container mx-auto">
        <div>
            <h1 class="text-orange-500">Journal des paiements</h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <div class="shadow-2xl border border-gray-300 overflow-hidden container px-2">
                    <vs-table :data="journals" search pagination max-items="15" noDataText="Aucune donnée disponible">
                        <template slot="thead">
                            <vs-th>Date validation</vs-th>
                            <vs-th>Code client</vs-th>
                            <vs-th>Client</vs-th>
                            <vs-th>Montant</vs-th>
                            <vs-th>N° réçu</vs-th>
                            <vs-th>Effectué par</vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr v-for="item in data" :data="item" :key="item.id">
                                <vs-td :data="item.date_validation">{{getDate(item.date_validation)}}</vs-td>
                                <vs-td :data="item.reglement.client">
                                    <span class="uppercase">{{item.reglement.client.identifiant}}</span>
                                </vs-td>
                                <vs-td :data="item.reglement.client">{{item.reglement.client.nom}} {{item.reglement.client.prenom}}</vs-td>
                                <vs-td :data="item.montant">{{item.montant | number('0,0', { thousandsSeparator: ' ' })}} Frs</vs-td>
                                <vs-td :data="item.reglement">{{item.reglement.reference}}</vs-td>
                                <vs-td :data="item.user.nom">{{item.user.nom}}</vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import * as moment from 'moment';
    export default {
       layout: Layout,
        metaInfo: {title: 'Journal des paiements'},
        props: {
           journals: Array,
        },
        methods: {
           getDate(date) {
               return moment(date).format('DD/MM/YYYY');
           }
        }
    }
</script>

<style scoped>

</style>
