<template>
    <div class="container mx-auto">
        <div>
            <h1>Tableau des statistiques</h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full mb-2">
                <vs-card>
                    <template slot="header"></template>
                    <div>
                        <div class="flex">
                            <div>
                                <vs-chip color="success" transparent >
                                    <vs-avatar icon="account_box"></vs-avatar>
                                    <span class="text-base font-bold"> Nombre de client enregistrés </span>
                                    <span class="text-base font-bold mx-1"> {{nbClients}}</span>
                                </vs-chip>
                            </div>
                            <div>
                                <vs-chip color="primary" transparent>
                                    <vs-avatar icon="home"></vs-avatar>
                                    <span class="font-bold text-base"> Nombre de maisons disponibles</span>
                                    <span class="font-bold text-base mx-1">{{nbMaisonsDispo.nb}}</span>
                                </vs-chip>
                            </div>
                            <div></div>
                        </div>
                    </div>
                </vs-card>
            </div>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card>
                    <div slot="header"></div>
                    <div>
                        <vs-tabs>
                            <vs-tab label="Statistiques"></vs-tab>
                            <vs-tab label="Clients">
                                <div>
                                    <vs-table :data="clients" noDataText="Aucune donnée disponible" pagination max-items="15">
                                        <template slot="header">
                                            <h3>Clients</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th>Nom</vs-th>
                                            <vs-th>Prénoms</vs-th>
                                            <vs-th>Profession</vs-th>
                                            <vs-th>CNI</vs-th>
                                            <vs-th>Date de naissance</vs-th>
                                            <vs-th>Lieu de naissance</vs-th>
                                            <vs-th>Résidence</vs-th>
                                            <vs-th>Téléphone 1</vs-th>
                                            <vs-th>Téléphone 2</vs-th>
                                            <vs-th>Réseau 1</vs-th>
                                            <vs-th>Réseau 2</vs-th>
                                            <vs-th>Email</vs-th>
                                            <vs-th>Banque</vs-th>
                                            <vs-th>Numero de compte</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.nom">{{item.nom}}</vs-td>
                                                <vs-td :data="item.prenom">{{item.prenom}}</vs-td>
                                                <vs-td :data="item.profession">{{item.profession}}</vs-td>
                                                <vs-td :data="item.cni">{{item.cni}}</vs-td>
                                                <vs-td :data="item.date_naissance">{{item.date_naissance}}</vs-td>
                                                <vs-td :data="item.lieu_naissance">{{item.lieu_naissance}}</vs-td>
                                                <vs-td :data="item.residence">{{item.residence}}</vs-td>
                                                <vs-td :data="item.tel_principal">{{item.tel_principal}}</vs-td>
                                                <vs-td :data="item.tel_secondaire">{{item.tel_secondaire}}</vs-td>
                                                <vs-td :data="item.reseau_principal">{{item.reseau_principal}}</vs-td>
                                                <vs-td :data="item.reseau_secondaire">{{item.reseau_secondaire}}</vs-td>
                                                <vs-td :data="item.email">{{item.email}}</vs-td>
                                                <vs-td :data="item.banque">{{item.banque}}</vs-td>
                                                <vs-td :data="item.numero_compte">{{item.numero_compte}}</vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </vs-tab>
                            <vs-tab label="Maisons">
                                <div>
                                    <vs-table :data="maisons" noDataText="Aucune donnée disponible" pagination max-items="15">
                                        <template slot="header">
                                            <h3>Maisons</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th>Standing</vs-th>
                                            <vs-th>Superficie</vs-th>
                                            <vs-th>Prix unitaire</vs-th>
                                            <vs-th>Programme</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.standing">
                                                    {{item.standing}}
                                                </vs-td>
                                                <vs-td :data="item.superficie">
                                                    {{item.superficie}}
                                                </vs-td>
                                                <vs-td :data="item.prix_unitaire">
                                                    {{item.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}}
                                                </vs-td>
                                                <vs-td :data="item.programme">
                                                    <div v-if="item.programme">
                                                        {{item.programme.code}}
                                                    </div>
                                                </vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </vs-tab>
                            <vs-tab label="Souscriptions">
                                <div>
                                    <vs-table :data="souscriptions" noDataText="Aucune donnée disponible" pagination max-items="15">
                                        <template slot="header">
                                            <h3>Souscriptions</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th>Date souscription</vs-th>
                                            <vs-th>Maison</vs-th>
                                            <vs-th>Client</vs-th>
                                            <vs-th>Apport initial</vs-th>
                                            <vs-th>Solde initial</vs-th>
                                            <vs-th>Option paiement</vs-th>
                                            <vs-th>Ecart paiement</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.date_souscription">
                                                    {{changedate(item.date_souscription)}}
                                                </vs-td>
                                                <vs-td :data="item.maison">
                                                    <div v-if="item.maison">
                                                        {{item.maison.standing}}
                                                    </div>
                                                </vs-td>
                                                <vs-td :data="item.client">
                                                    <div v-if="item.client">
                                                        {{item.client.nom}} {{item.client.prenom}}
                                                    </div>
                                                </vs-td>
                                                <vs-td :data="item.apport_initial">
                                                    {{item.apport_initial | number('0,0', { thousandsSeparator: ' ' })}}
                                                </vs-td>
                                                <vs-td :data="item.solde_initial">
                                                    {{item.solde_initial | number('0,0', { thousandsSeparator: ' ' })}}
                                                </vs-td>
                                                <vs-td :data="item.option_paiement">
                                                    {{item.option_paiement}} Mois
                                                </vs-td>
                                                <vs-td :data="item.ecart_paie">
                                                    {{item.ecart_paie}} Mois
                                                </vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </vs-tab>
                            <vs-tab label="Reglements">
                                <div>
                                    <vs-table :data="reglements" noDataText="Aucune donnée disponible" pagination max-items="15">
                                        <template slot="header">
                                            <h3>Reglements</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th>Date reglement</vs-th>
                                            <vs-th>Maison</vs-th>
                                            <vs-th>Client</vs-th>
                                            <vs-th>Montant</vs-th>
                                            <vs-th>Mode reglement</vs-th>
                                            <vs-th>Num cheque</vs-th>
                                            <vs-th>Date cheque</vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.date_reglement">
                                                    {{changedate(item.date_reglement)}}
                                                </vs-td>
                                                <vs-td :data="item.maison"><div v-if="item.maison">{{item.maison.standing}}</div></vs-td>
                                                <vs-td :data="item.client"><div v-if="item.client">{{item.client.nom}} {{item.client.prenom}}</div></vs-td>
                                                <vs-td :data="item.montant">{{item.montant | number('0,0', { thousandsSeparator: ' ' })}}</vs-td>
                                                <vs-td :data="item.mode_reglement">{{item.mode_reglement}}</vs-td>
                                                <vs-td :data="item.num_cheque">
                                                    <span v-if="item.num_cheque">
                                                        {{item.num_cheque}}
                                                    </span>
                                                    <span class="text-red-500" v-if="!item.num_cheque">
                                                        pas de cheque
                                                    </span>
                                                </vs-td>
                                                <vs-td :data="item.date_cheque">{{item.date_cheque}}</vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                </div>
                            </vs-tab>
                        </vs-tabs>
                    </div>
                </vs-card>
            </div>
        </div>

    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import * as moment from 'moment'
    export default {
        metaInfo: {title: 'Statistique'},
        layout: Layout,
        props: {
            clients: Array,
            maisons: Array,
            souscriptions: Array,
            reglements: Array,
            nbClients: Number,
            nbMaisonsDispo: Object,
        },
        methods: {
            changedate(date) {
                return moment(date).locale('fr').format('Do MMMM YYYY');
            }
        }
    }
</script>

<style scoped>

</style>
