<template>
    <div class="container mx-auto">
        <div class="flex my-4">
            <div class="mx-4">
                <h1 class=" font-bold text-orange-500 text-3xl">
                    Etats financiers
                </h1>
            </div>
            <div class="mx-4">
                <vs-button @click="$inertia.replace(route('finances.etats'))" type="border" color="success">Etats des lieux financiers</vs-button>
            </div>
            <div class="mx-4">
                <vs-button type="border" color="success">Impression etat client</vs-button>
            </div>
        </div>
        <div class="container mx-auto">
            <div class="grid grid-cols-3 gap-4">
            <div class="col-span-1">
                <div>
                    <vs-card v-if="selectedItem" class="">
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full md:w-1/2">
                                <span class="text-color-base font-medium text-base">Nom et prénoms</span>
                            </div>
                            <div class="vx-col w-full md:w-1/2">
                                <span class="text-blue-500 font-bold uppercase">{{selectedItem.nom}} {{selectedItem.prenom}}</span>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full md:w-1/2">
                                <span class="text-color-base text-base font-medium">Téléphone</span>
                            </div>
                            <div class="vx-col w-full md:w-1/2">
                                <span class="text-blue-500 font-bold">{{selectedItem.tel_principal}}</span>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full md:w-1/2">
                                <span class="text-color-base text-base font-medium">Numero de compte</span>
                            </div>
                            <div class="vx-col w-full md:w-1/2">
                                <span class="text-blue-500 font-bold uppercase">{{selectedItem.numero_compte}}</span>
                            </div>
                        </div>
                    </vs-card>
                </div>
                <div>
                    <vs-card>
                        <vs-table pagination max-items="15" search :data="clients" v-model="selectedItem"
                                  @selected="selectedClient" noDataText="Aucune donnée disponible">
                            <template slot="header">
                                <h3>Clients</h3>
                            </template>
                            <template slot="thead">
                                <vs-th><span class="text-color-base">Nom</span></vs-th>
                                <vs-th><span class="text-color-base">prénoms</span></vs-th>
                            </template>
                            <template slot-scope="{data}">
                                <vs-tr :data="item" :key="item.id" v-for="item in data">
                                    <vs-td :data="item.nom">
                                        {{item.nom}}
                                    </vs-td>
                                    <vs-td :data="item.prenom">
                                        {{item.prenom}}
                                    </vs-td>
                                </vs-tr>
                            </template>
                        </vs-table>
                    </vs-card>
                </div>
            </div>
            <div class="col-span-2">
                <div>
                    <vs-tabs>
                        <vs-tab label="Résumé paiement client">
                           <div v-if="selectedItem">
                                <div class="grid grid-cols-2 gap-6 mb-4">
                                    <div >
                                        <vs-card>
                                            <div class="p-6 text-center bg-orange-300">
                                                <vs-avatar icon="home" size="70px" color="#f6ad55"></vs-avatar>
                                                <div class="truncate">
                                                    <h2 class="font-bold mb-1">
                                                        {{selectedItem.souscription.maison.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} frs
                                                    </h2>
                                                    <span class="font-medium text-lg text-color-base">Montant de la maison souscrite par le client</span>
                                                </div>
                                            </div>
                                        </vs-card>
                                    </div>
                                    <div>
                                        <vs-card>
                                            <div class="p-6 text-center bg-orange-300">
                                                <vs-avatar icon="local_atm" size="70px" color="#f6ad55"></vs-avatar>
                                                <div class="truncate">
                                                    <h2 class="font-bold mb-1">

                                                        {{ selectedItem.somme_reglements.length > 0 ? selectedItem.somme_reglements[0].somme : 0 | number('0,0', { thousandsSeparator: ' ' })}} frs
                                                    </h2>
                                                    <span class="font-medium text-lg text-color-base">Montant total versé par le client</span>
                                                </div>
                                            </div>
                                        </vs-card>
                                    </div>
                                    <div>
                                        <vs-card>
                                            <div class="p-6 text-center bg-green-300">
                                                <vs-avatar icon="home" size="70px" color="#48bb78"></vs-avatar>
                                                <div class="truncate">
                                                    <h2 class="font-bold mb-1">
                                                        {{restePayer | number('0,0', { thousandsSeparator: ' ' })}} frs
                                                    </h2>
                                                    <span class="font-medium text-lg text-color-base">Montant restant à payer par le client</span>
                                                </div>
                                            </div>
                                        </vs-card>
                                    </div>
                                    <div>
                                        <vs-card>
                                            <div class="p-6 text-center bg-green-300">
                                                <vs-avatar icon="local_atm" size="70px" color="#48bb78"></vs-avatar>
                                                <div class="truncate">
                                                    <h2 class="font-bold mb-1">
                                                        {{Math.round(pourcentagePaiement, 2)}} %
                                                    </h2>
                                                    <span class="font-medium text-lg text-color-base">Pourcentage paiement</span>
                                                </div>
                                            </div>
                                        </vs-card>
                                    </div>
                                </div>

                               <div>
                                   <div class="vx-row">
                                       <div class="vx-col w-full">
                                           <vs-card v-if="selectedItem">
                                               <div slot="header">
                                                   <h3 class="text-green-500">Commentaire</h3>
                                               </div>
                                               <div class="font-bold">
                                                   <p class="text-base">Le client {{selectedItem.nom}} {{selectedItem.prenom}} a souscrit a une maison de type {{selectedItem.souscription.maison.standing}}
                                                       avec une superficie de {{selectedItem.souscription.maison.superficie}} m².
                                                   </p>
                                                   <p class="text-base">Le prix de la maison est de {{selectedItem.souscription.maison.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} frs CFA,
                                                       le client a payé {{Math.round(pourcentagePaiement, 2)}} % du prix de la maison, soit un montant total de {{totalPaiement | number('0,0', { thousandsSeparator: ' ' })}} frs CFA</p>
                                                   <p class="text-base">Il reste donc au client à payer la somme de : {{restePayer | number('0,0', { thousandsSeparator: ' ' })}} frs CFA</p>
                                               </div>
                                           </vs-card>
                                       </div>
                                   </div>
                               </div>
                           </div>
                        </vs-tab>
                        <vs-tab label="Paiement">
                            <div v-if="selectedItem">
                                <vs-card>
                                    <vs-table pagination max-items="15" :data="selectedItem.reglements" search noDataText="Aucune donnée disponible">
                                        <template slot="header">
                                            <h3>Paiement validé</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th><span>Date reglement</span></vs-th>
                                            <vs-th><span>Montant réglé</span></vs-th>
                                            <vs-th><span>Mode reglement</span></vs-th>
                                            <vs-th><span>Numero cheque</span></vs-th>
                                            <vs-th><span>Date cheque</span></vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.date_reglement">
                                                    {{formatDate(item.date_reglement)}}
                                                </vs-td>
                                                <vs-td :data="item.montant">
                                                    {{item.montant | number('0,0', { thousandsSeparator: ' ' })}} Frs
                                                </vs-td>
                                                <vs-td :data="item.mode_reglement">
                                                    {{item.mode_reglement}}
                                                </vs-td>
                                                <vs-td :data="item.num_cheque">
                                                    {{item.num_cheque}}
                                                </vs-td>
                                                <vs-td :data="item.date_cheque">
                                                    {{item.date_cheque}}
                                                </vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </vs-card>
                            </div>
                        </vs-tab>
                        <vs-tab label="Echéancier">
                            <div v-if="selectedItem">
                                <vs-card>
                                    <div class="my-4 flex">
                                        <div class="w-full md:w-1/2">
                                            <div class="vx-row">
                                                <div class="vx-col w-full md:w-1/2"><span class="text-blue-500 text-base">Option de Paiement</span></div>
                                                <div class="vx-col w-full md:w-1/2"><span class="font-bold text-base">{{selectedItem.souscription.option_paiement}} Mois</span></div>
                                            </div>
                                            <div class="vx-row">
                                                <div class="vx-col w-full md:w-1/2"><span class="text-blue-500 text-base">Date première echeance</span></div>
                                                <div class="vx-col w-full md:w-1/2"><span class="font-bold text-base">{{formatDate(selectedItem.souscription.date_echeance_1)}}</span></div>
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/2">
                                            <div class="vx-row">
                                                <div class="vx-col w-full md:w-1/2">
                                                    <span class="text-blue-500 text-base">Ecart de paiement</span>
                                                </div>
                                                <div class="vx-col w-full md:w-1/2">
                                                <span class="font-bold text-base">
                                                    {{selectedItem.souscription.ecart_paie}} Mois
                                                </span>
                                                </div>
                                            </div>
                                            <div class="vx-row">
                                                <div class="vx-col w-full md:w-1/2">
                                                    <span class="text-blue-500 text-base">Date derniere echeance</span>
                                                </div>
                                                <div class="vx-col w-full md:w-1/2">
                                                <span class="font-bold text-base">
                                                    {{formatDate(selectedItem.souscription.date_echeance_2)}}
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </vs-card>
                                <vs-card>
                                    <vs-table :data="selectedItem.souscription.echeanciers" pagination max-items="15" search noDataText="Aucune donnée disponible">
                                        <template slot="header">
                                            <h3 class="text-blue-500">Echeanciers</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th><span>Ordre</span></vs-th>
                                            <vs-th><span>Date echeance</span></vs-th>
                                            <vs-th><span>Montant</span></vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.numero_ordre">{{item.numero_ordre}}</vs-td>
                                                <vs-td :data="item.date_echeance">{{item.jour}}/{{item.mois}}/{{item.annee}}</vs-td>
                                                <vs-td :data="item.montant">{{item.montant}}</vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </vs-card>
                            </div>
                        </vs-tab>
                        <vs-tab label="Souscription">
                            <div v-if="selectedItem">
                                <div>
                                    <vs-card>
                                        <div slot="header">
                                           <h3> Maison</h3>
                                        </div>
                                        <div class="">
                                            <div class="w-full md:w-1/2">
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full md:w-1/3">
                                                        <span class="text-blue-500 text-base">Standing</span>
                                                    </div>
                                                    <div class="vx-col w-full md:w-2/3">
                                                        <span class="font-bold text-base">
                                                            {{selectedItem.souscription.maison.standing}}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full md:w-1/3">
                                                        <span class="text-blue-500 text-base">Superficie</span>
                                                    </div>
                                                    <div class="vx-col w-full md:w-2/3">
                                                        <span class="font-bold text-base">
                                                            {{selectedItem.souscription.maison.superficie}} m²
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full md:w-1/2">
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full md:w-1/3">
                                                        <span class="text-blue-500 text-base">Prix unitaire</span>
                                                    </div>
                                                    <div class="vx-col w-full md:w-2/3">
                                                        <span class="font-bold text-base">
                                                            {{selectedItem.souscription.maison.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} frs
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </vs-card>
                                    <vs-card>
                                        <div slot="header">
                                            <h3>Souscription</h3>
                                        </div>
                                        <div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/6">
                                                    <span class="text-blue-500 text-base">
                                                        date souscription
                                                    </span>
                                                </div>
                                                <div class="vx-col w-full sm:w-5/6">
                                                    <span class="font-bold text-base">
                                                        {{formatDate(selectedItem.souscription.date_souscription)}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/6">
                                                    <span class="text-blue-500 text-base">
                                                       Apport initial
                                                    </span>
                                                </div>
                                                <div class="vx-col w-full sm:w-5/6">
                                                    <span class="font-bold text-base">
                                                        {{selectedItem.souscription.apport_initial | number('0,0', { thousandsSeparator: ' ' })}} Frs
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/6">
                                                    <span class="text-blue-500 text-base">
                                                       Solde initial
                                                    </span>
                                                </div>
                                                <div class="vx-col w-full sm:w-5/6">
                                                    <span class="font-bold text-base">
                                                        {{selectedItem.souscription.solde_initial | number('0,0', { thousandsSeparator: ' ' })}} Frs
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </vs-card>
                                </div>
                            </div>
                        </vs-tab>
                    </vs-tabs>

                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import * as moment from 'moment';

    export default {
        metaInfo: {title: 'Espace finance'},
        layout: Layout,
        data () {
            return {
                selectedItem: null,
            }
        },
        computed: {
            restePayer() {
                if (this.selectedItem) {
                    return this.soldeInitial - this.totalPaiement;
                }
            },
            totalPaiement() {
                if (this.selectedItem && this.selectedItem.somme_reglements[0]) {
                    return this.selectedItem.somme_reglements[0].somme
                } else {
                    return 0;
                }
            },
            soldeInitial() {
                if (this.selectedItem && this.selectedItem.souscription) {
                    return parseInt(this.selectedItem.souscription.solde_initial);
                } else {
                    return 0;
                }
            },
            pourcentagePaiement() {
                if (this.selectedItem) {
                    return (this.totalPaiement / this.soldeInitial) * 100;
                }
            }
        },
        props: {
            clients: Array,
        },
        methods: {
            selectedClient (val) {
                this.selectedItem = val;
            },
            formatDate(date) {
                return moment(date).format('DD/MM/YYYY');
            }
        }
    }
</script>

<style scoped>

</style>
