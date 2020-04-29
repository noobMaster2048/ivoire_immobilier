<template>
    <div class="container mx-auto">
        <div class="mx-8 mb-8">
            <h1 class="text-orange-500 font-bold text-3xl">Journal des actions</h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <vs-card>
                    <vs-table :data="logs" search pagination max-items="15" noDataText="Aucune donnée disponible">
                        <template slot="thead">
                            <vs-th>Opération sur</vs-th>
                            <vs-th>Type opération</vs-th>
                            <vs-th>Date opération</vs-th>
                            <vs-th>Effectué par</vs-th>
                            <vs-th>Montant payé</vs-th>
                            <vs-th>Description</vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr v-for="item in data" :key="item.id" :data="item">
                                <vs-td :data="item.objet_type"><span class="uppercase">{{item.objet_type}}</span></vs-td>
                                <vs-td :data="item.libelle"><span class="uppercase">{{item.libelle}}</span></vs-td>
                                <vs-td :data="item.created_at"><span class="uppercase">{{getDate(item.created_at)}}</span></vs-td>
                                <vs-td :data="item.user.id"><span class="uppercase">{{item.user.nom}}</span></vs-td>
                                <vs-td :data="item.montant_paye"><span class="uppercase">{{item.montant_paye}}</span></vs-td>
                                <vs-td :data="item.description"><span class="uppercase">{{item.description}}</span></vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </vs-card>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import * as moment from 'moment';

    export default {
       layout: Layout,
        metaInfo: {title: 'Journal des actions'},
        props: {
           logs: Array,
        },
        methods: {
           getDate(date) {
               return moment(date).format('DD/MM/YYYY HH:mm:ss')
           }
        }
    }
</script>

<style scoped>

</style>
