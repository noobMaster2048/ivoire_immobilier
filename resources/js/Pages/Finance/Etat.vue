<template>
    <div class="container mx-auto">
        <div class="m-4 flex flex-wrap">
            <div class="mx-2">
                <h1 class="font-bold text-3xl">
                    <inertia-link :href="route('finances')" class="text-danger">retour</inertia-link>
                    <span class="text-danger font-medium">/</span>
                    <span class="uppercase text-orange-500">etats des lieux financiers</span>
                </h1>
            </div>
            <div class="mx-2">
                <a href="/finances/export">
                    <vs-button type="border" color="success" icon="get_app" size="small">Exporter vers excel</vs-button>
                </a>
            </div>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <vs-card>
                    <vs-table :data="etats" pagination max-items="15" search noDataText="Aucune donnée">
                        <template slot="thead">
                            <vs-th>Nom</vs-th>
                            <vs-th>Prénoms</vs-th>
                            <vs-th>Prix unitaire</vs-th>
                            <vs-th>Apport initial</vs-th>
                            <vs-th>Montant total versé</vs-th>
                            <vs-th>Pourcentage total</vs-th>
                            <vs-th>Pourcentage apport initial</vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr v-for="item in data" :key="item.id" :data="item">
                                <vs-td :data="item.nom">{{item.nom}}</vs-td>
                                <vs-td :data="item.prenom">{{item.prenom}}</vs-td>
                                <vs-td :data="item.prix">{{item.prix | number('0,0', { thousandsSeparator: ' ' })}} Frs</vs-td>
                                <vs-td :data="item.apport">{{item.apport | number('0,0', { thousandsSeparator: ' ' })}} Frs</vs-td>
                                <vs-td :data="item.total">{{item.total | number('0,0', { thousandsSeparator: ' ' })}} Frs</vs-td>
                                <vs-td :data="item.pourcentage">{{item.pourcentage}} %</vs-td>
                                <vs-td :data="item.pourcentage_apport">{{item.pourcentage_apport}} %</vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </vs-card>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from "@/Shared/Layout";

    export default {
       metaInfo: {title: 'Etats des lieux financiers'},
        layout: Layout,
        props: {
           etats: Array,
        }
    }
</script>

<style scoped>

</style>
