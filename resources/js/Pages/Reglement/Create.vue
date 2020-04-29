<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('clients')">Clients</inertia-link>
                <span class="text-danger font-medium">/</span> Reglement
            </h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card fixedHeight>
                    <div slot="header">
                       <div class="flex justify-between">
                           <div> <h4 class="font-bold text-green-800">Formulaire reglement</h4></div>
                           <div class="flex">
                              <div class="mx-4 flex items-center">
                                  <div>
                                      <span class="text-green-400 font-bold text-xl"> Nombre de versements {{nbr_versement.total}}</span>
                                  </div>
                                  <div>
                                      <span>
                                      <vs-checkbox v-model="afficheReglement" color="success"></vs-checkbox>
                                  </span>
                                  </div>
                              </div>
                               <div class="mx-4">
                                   <span class="text-green-400 font-bold text-xl">Reste a payer par le client {{restePayer | number('0,0', { thousandsSeparator: ' ' })}}</span>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-2 gap-8">
                            <div class="">
                                <fieldset class="mx-4 px-4">
                                    <legend class="uppercase">Client</legend>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Nom et prénoms</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-blue-500 uppercase">{{client.nom}} {{client.prenom}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Contact</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-blue-500 uppercase">{{client.tel_principal}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Numero de compte</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-blue-500 uppercase">{{client.numero_compte}} </span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="">
                            <fieldset class="mx-4 px-4">
                                <legend class="uppercase">Reglement</legend>
                                <div class="vx-row pb-6">
                                    <div class="vx-col w-full sm:w-2/6">
                                        <span class="font-semibold text-color-base text-base">Date reglement</span>
                                    </div>
                                    <div class="vx-col w-full sm:w-4/6">
                                        <vs-input class="w-full" v-model="form.date_reglement" type="date"></vs-input>
                                    </div>
                                </div>
                                <div class="vx-row pb-6">
                                    <div class="vx-col w-full sm:w-2/6">
                                        <span class="font-semibold text-color-base text-base">Montant</span>
                                    </div>
                                    <div class="vx-col w-full sm:w-4/6">
                                        <vs-input class="w-full" v-model="form.montant" :danger="checkMontant" danger-text="Le montant est requis"></vs-input>
                                    </div>
                                </div>
                                <div class="vx-row pb-6">
                                    <div class="vx-col w-full sm:w-2/6">
                                        <span class="font-semibold text-color-base text-base">Mode de reglement</span>
                                    </div>
                                    <div class="vx-col w-full sm:w-4/6">
                                       <vs-select class="w-full" v-model="form.mode_reglement" autocomplete :danger="checkModeRegl" danger-text="Le mode reglement est requis">
                                           <vs-select-item value="ESPECE" text="ESPECE"></vs-select-item>
                                           <vs-select-item value="CHEQUE" text="CHEQUE"></vs-select-item>
                                           <vs-select-item value="VIREMENT" text="VIREMENT"></vs-select-item>
                                       </vs-select>
                                    </div>
                                </div>
                                <div v-if="form.mode_reglement =='CHEQUE'">
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="font-semibold text-color-base text-base">Numero du chéque</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.num_cheque"></vs-input>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="font-semibold text-color-base text-base">Date du chéque</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.date_cheque"></vs-input>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            </div>
                            <div>
                                <fieldset class="mx-4 px-4">
                                    <legend class="uppercase">Maison</legend>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Standing</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-color-base uppercase">{{client.souscription.maison.standing}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Superficie</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-color-base uppercase">{{client.souscription.maison.superficie}} m²</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Prix unitaire</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-color-base uppercase">{{client.souscription.maison.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} Frs</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="vx-row pb-6" v-if="afficheReglement">
                            <div class="vx-col w-full">
                                <vs-table :data="client.reglements" pagination max-items="15" noDataText="Aucune donnée disponible">
                                    <template></template>
                                    <template slot="thead">
                                        <vs-th>Date reglement</vs-th>
                                        <vs-th>Montant</vs-th>
                                        <vs-th>Mode reglement</vs-th>
                                        <vs-th>N° cheque</vs-th>
                                        <vs-th>Date cheque</vs-th>
                                    </template>
                                    <template slot-scope="{data}">
                                        <vs-tr :data="item" v-for="item in data" :key="item.id">
                                            <vs-td :data="item.date_reglement">{{getDate(item.date_reglement)}}</vs-td>
                                            <vs-td :data="item.montant">{{item.montant | number('0,0', { thousandsSeparator: ' ' })}} Frs</vs-td>
                                            <vs-td :data="item.mode_reglement">{{item.mode_reglement}}</vs-td>
                                            <vs-td :data="item.num_cheque">{{item.num_cheque}}</vs-td>
                                            <vs-td :data="item.date_cheque">{{item.date_cheque}}</vs-td>
                                        </vs-tr>
                                    </template>
                                </vs-table>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="vx-row pt-6">
                                <div class="flex vx-col sm:w-5/6 w-full ml-auto">
                                    <vs-button @click="$inertia.replace(route('clients'))" icon="replay" color="danger">Annuler</vs-button>
                                    <vs-button :disabled="sending" @click="save" color="success" icon="save" class="mx-2">Enregistrer</vs-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </vs-card>
            </div>
        </div>
    </div>
</template>
<script>
import Layout from '@/Shared/layout';
import * as moment from 'moment';
export default {
    metaInfo: {title: 'Formulaire reglement'},
        layout: Layout,
        props: {
            client: Object,
            flash: Object,
            nbr_versement: Object,
        },
        data () {
            return {
                sending: false,
                afficheReglement: false,
                selectedRegl: null,
                form: {
                    client_id: this.client.id,
                    maison_id: this.client.souscription.maison.id,
                    souscription: this.client.souscription.id,
                    date_reglement: moment().format().slice(0,10),
                    montant: null,
                    mode_reglement: null,
                    num_cheque: null,
                    date_cheque: null,
                    jour: null,
                    mois: null,
                    annee: null,
                }
            }
        },
        computed: {
            restePayer() {
                return this.soldeInitial - this.totalPaiement;
            },
            totalPaiement() {
              if (this.client.somme_reglements) {
                  return parseInt(this.client.somme_reglements.somme);
              } else {
                  return 0
              }
            },
            soldeInitial() {
                return parseInt(this.client.souscription.solde_initial);
            },
            checkMontant() {
                if (this.$page.errors.montant) {
                    return true;
                } else {
                    return false;
                }
            },
            checkModeRegl() {
                if (this.$page.errors.mode_reglement) {
                    return true;
                } else {
                    return false;
                }
            },
            errorMontant() {
                if (this.$page.errors.montant) {
                    return this.$page.errors.montant[0]
                }
            },
            errorMontant() {
                if (this.$page.errors.mode_reglement) {
                    return this.$page.errors.mode_reglement[0]
                }
            }
        },
        methods: {
            save() {
                this.sending = true;
                this.$inertia.post(this.route('reglement.store'), this.form).then(() => {
                    this.sending = false
                });
            },
            getDate(date) {
                return moment(date).format('DD/MM/YYYY');
            },
        }
}
</script>
