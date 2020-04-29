<template>
    <div class="container mx-auto">
        <div class="m-4">
            <h1 class="uppercase font-bold text-orange-500">reçu</h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <div>
                    <vs-tabs position="left">
                        <vs-tab label="Reçus en attente">
                            <vs-card>
                                <div>
                                    <vs-table v-model="item" @selected="selectedItem" :data="attentes" pagination max-items="15" noDataText="Aucune donnée">
                                        <template slot="thead">
                                            <vs-th>Nom et prénoms</vs-th>
                                            <vs-th>Téléphone</vs-th>
                                            <vs-th>Réference</vs-th>
                                            <vs-th>Date reglement</vs-th>
                                            <vs-th>Type reglement</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr v-for="item in data" :key="item.id" :data="item">
                                                <vs-td :data="item.client.nom">{{item.client.nom}} {{item.client.prenom}}</vs-td>
                                                <vs-td :data="item.client.tel_principal">{{item.client.tel_principal}}</vs-td>
                                                <vs-td :data="item.reference">{{item.reference}}</vs-td>
                                                <vs-td :data="item.date_reglement">{{dateFormat(item.date_reglement)}}</vs-td>
                                                <vs-td :data="item.type_regl">{{item.type_regl}}</vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                                <div>
                                    <div class="grid grid-cols-3 gap-6" v-if="item">
                                        <div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">n° réçu</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.reference}}</span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">logement</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.client.souscription.maison.standing}}</span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">mode de versement</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.mode_reglement}}</span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">solde précédent</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.mode_reglement}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">nom et prénoms</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.client.nom}} {{item.client.prenom}}</span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">date souscription</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{dateFormat(item.client.souscription.date_souscription)}}</span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">montant versé</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.montant | number('0,0', { thousandsSeparator: ' ' })}} frs</span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">n° chèque</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.num_cheque ? item.num_cheque : 'N/A'}} </span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">nouveau solde</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.num_cheque}} </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">d'un montant de</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.num_cheque}} </span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">date de versement</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{dateFormat(item.date_reglement)}} </span>
                                                </div>
                                            </div>
                                            <div class="vx-row pb-6">
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="text-base text-blue-500 font-medium capitalize">date chèque</span>
                                                </div>
                                                <div class="vx-col w-full sm:w-1/2">
                                                    <span class="capitalize font-medium text-color-base text-base">{{item.date_cheque ? dateFormat(item.date_cheque) : 'N/A'}} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap">
                                        <div class="mx-2">
                                            <vs-button color="success" type="border">Imprimer</vs-button>
                                        </div>
                                        <div class="mx-2">
                                            <vs-button color="danger" type="border">Annuler le paiement</vs-button>
                                        </div>
                                        <div class="mx-2">
                                            <vs-button color="primary" type="border">Exporter vers excel</vs-button>
                                        </div>
                                    </div>
                                </div>
                            </vs-card>
                        </vs-tab>
                        <vs-tab label="Reçus validés">
                            <vs-card>
                                <div>
                                    <vs-table :data="valides" pagination max-items="15" noDataText="Aucune donnée">
                                        <template slot="thead">
                                            <vs-th>Nom et prénoms</vs-th>
                                            <vs-th>Téléphone</vs-th>
                                            <vs-th>Réference</vs-th>
                                            <vs-th>Date reglement</vs-th>
                                            <vs-th>Type reglement</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr v-for="item in data" :key="item.id" :data="item">
                                                <vs-td :data="item.client.nom">{{item.client.nom}} {{item.client.prenom}}</vs-td>
                                                <vs-td :data="item.client.tel_principal">{{item.client.tel_principal}}</vs-td>
                                                <vs-td :data="item.reference">{{item.reference}}</vs-td>
                                                <vs-td :data="item.date_reglement">{{item.date_reglement}}</vs-td>
                                                <vs-td :data="item.type_regl">{{item.type_regl}}</vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </vs-card>
                        </vs-tab>
                        <vs-tab label="Reçus annulés">
                            <vs-card>
                                <div>
                                    <vs-table :data="annules" pagination max-items="15" noDataText="Aucune donnée">
                                        <template slot="thead">
                                            <vs-th>Nom</vs-th>
                                            <vs-th>Téléphone</vs-th>
                                            <vs-th>Référence</vs-th>
                                            <vs-th>Date reglement</vs-th>
                                            <vs-th>Type reglement</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr v-for="item in data" :key="item.id" :data="item">
                                                <vs-td :data="item.client.nom">{{item.client.nom}} {{item.client.prenom}}</vs-td>
                                                <vs-td :data="item.client.tel_principal">{{item.client.tel_principal}}</vs-td>
                                                <vs-td :data="item.reference">{{item.reference}}</vs-td>
                                                <vs-td :data="item.date_reglement">{{item.date_reglement}}</vs-td>
                                                <vs-td :data="item.type_regl">{{item.type_regl}}</vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </vs-card>
                        </vs-tab>
                    </vs-tabs>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from "@/Shared/Layout"
    import * as moment from 'moment';

    export default {
        metaInfo: {title: 'Réçu'},
        layout: Layout,
        data() {
            return {
                item: null,
            }
        },
        props: {
            attentes: Array,
            valides: Array,
            annules: Array,
        },
        methods: {
            dateFormat(date) {
                return moment(date).format('DD/MM/YYYY');
            },
            selectedItem(val) {
                this.item = val;
            }
        }
    }
</script>

<style scoped>

</style>
