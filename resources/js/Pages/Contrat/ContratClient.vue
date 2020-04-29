<template>
    <div class="container mx-auto">
        <div class="bg-orange-400 m-4 h-auto flex flex-col py-6 px-2">
            <div class="mb-2">
                <h3 class="text-white">Liste des clients selon leur niveau de paiement</h3>
            </div>
            <div>
                <span class="text-white font-semibold">Nombre de clients respectants les critères selectionnés : {{clients.length}}</span>
                <vs-button color="success" @click="$inertia.replace(route('contrats.existant'))">Voir les contrats déja créés</vs-button>
                <vs-button v-if="selectedClient" color="success" @click="$inertia.replace(route('contrat.create', selectedClient.id))">Créer le contrat de ce client</vs-button>
            </div>
        </div>
        <div>
            <div class="vx-row">
                <div class="vx-col w-full">
                    <div class="shadow-2xl rounded container border border-gray-300 overflow-hidden px-2">
                        <vs-table :data="clients" @selected="selectedItem" search max-items="15" pagination noDataText="Aucune donnée disponible">
                            <template slot="thead">
                                <vs-th>Nom</vs-th>
                                <vs-th>Prénoms</vs-th>
                                <vs-th>Prix unitaire</vs-th>
                                <vs-th>Pourcentage montant</vs-th>
                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="item" v-for="item in data" :key="item.id">
                                    <vs-td :data="item.nom">{{item.nom}}</vs-td>
                                    <vs-td :data="item.prenom">{{item.prenom}}</vs-td>
                                    <vs-td :data="item.prix_unitaire">{{item.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} Frs</vs-td>
                                    <vs-td :data="item.pourcentage">{{item.pourcentage}}</vs-td>
                                </vs-tr>
                            </template>
                        </vs-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';

    export default {
        layout: Layout,
        metaInfo: { title: 'Contrats' },
        data() {
            return {
                selectedClient: null,
            }
        },
        props: {
            clients: Array,
        },
        methods: {
            selectedItem(element) {
                this.selectedClient = element;
            }
        }
    }
</script>

<style scoped>

</style>
