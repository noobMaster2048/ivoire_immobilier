<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('clients')">Clients</inertia-link>
                <span class="text-danger font-medium">/</span> Souscription
            </h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card fixedHeight>
                    <div slot="header">
                        <h4 class="font-bold text-green-800">Formulaire soucription</h4>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="w-full md:w-1/2">
                                <fieldset class="mx-4 px-4">
                                    <legend class="uppercase">Client</legend>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Nom et prénoms</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-blue-500">{{client.nom}} {{client.prenom}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Contact</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-blue-500">{{client.reseau_principal}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-1/3">
                                            <span class="font-semibold text-color-base text-base">Numero de compte</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-2/3">
                                            <span class="text-base text-blue-500">{{client.numero_compte}} </span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="w-full md:w-1/2">
                                <fieldset class="mx-4 px-4">
                                    <legend class="uppercase">Souscription</legend>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-base text-color-base font-semibold">Date souscription</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.date_souscription" type="date"></vs-input>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-base text-color-base font-semibold">Apport initial</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.apport_initial"></vs-input>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-base text-color-base font-semibold">Solde initial</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.solde_initial"></vs-input>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-4/6" v-if="selectedMaison">
                                            <span class="text-5xl text-red-500 font-semibold">{{form.apport_initial | number('0,0', { thousandsSeparator: ' ' })}}</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-full md:w-1/2">
                                <fieldset class="mx-4 px-4">
                                    <legend class="uppercase">
                                        Liste des maisons
                                    </legend>
                                    <vs-table v-model="selectedMaison" @selected="selectedItem"
                                        pagination max-items="5" search :data="maisons" noDataText="Aucune donnée disponible">
                                        <template slot="header">
                                            <h3 class="text-blue-700 font-sans text-2xl">Maisons</h3>
                                        </template>
                                        <template slot="thead">
                                            <vs-th>
                                                <span class="text-base"> Dénomination</span>
                                            </vs-th>
                                            <vs-th >
                                                <span class="text-base">Standing</span>
                                            </vs-th>
                                            <vs-th >
                                                <span class="text-base">Superficie</span>
                                            </vs-th>
                                            <vs-th >
                                                <span class="text-base">Prix unitaire</span>
                                            </vs-th>
                                            <vs-th></vs-th>
                                        </template>
                                        <template slot-scope="{data}">
                                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                                <vs-td :data="item.denomination">
                                                    {{item.denomination}}
                                                </vs-td>
                                                <vs-td :data="item.standing">
                                                    {{item.standing}}
                                                </vs-td>
                                                <vs-td :data="item.superficie">
                                                    {{item.superficie | number('0,0', { thousandsSeparator: ' ' })}}
                                                </vs-td>
                                                <vs-td :data="item.prix_unitaire">
                                                    {{item.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}}
                                                </vs-td>
                                            </vs-tr>
                                        </template>
                                    </vs-table>
                                    <div v-if="selectedMaison" class="my-4">
                                        <div class="vx-row pb-6">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-base font-semibold">dénomination</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-base text-color-base">{{selectedMaison.denomination}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-base font-semibold">Standing</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-base text-color-base">{{selectedMaison.standing}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-base font-semibold">Superficie</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-base text-color-base">{{selectedMaison.superficie}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-base font-semibold">Prix unitaire</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-base text-color-base">{{selectedMaison.prix_unitaire}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="w-full md:w-1/2">
                                <fieldset class="mx-4 px-4">
                                    <legend class="uppercase">Echeancier</legend>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-base text-color-base font-semibold">Option de paiement</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-select v-model="form.option_paiement" class="w-full" autocomplete>
                                                <vs-select-item value="12" text="12 Mois"></vs-select-item>
                                                <vs-select-item value="24" text="24 Mois"></vs-select-item>
                                                <vs-select-item value="36" text="36 Mois"></vs-select-item>
                                                <vs-select-item value="48" text="48 Mois"></vs-select-item>
                                                <vs-select-item value="60" text="60 Mois"></vs-select-item>
                                            </vs-select>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-base text-color-base font-semibold">Ecart de paiement</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-select v-model="form.ecart_paie" class="w-full" autocomplete>
                                                <vs-select-item value="1" text="1 Mois"></vs-select-item>
                                                <vs-select-item value="2" text="2 Mois"></vs-select-item>
                                                <vs-select-item value="3" text="3 Mois"></vs-select-item>

                                            </vs-select>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-color-base text-base font-semibold">Date première écheance</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.date_echeance_1" type="date"></vs-input>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full sm:w-2/6">
                                            <span class="text-color-base text-base font-semibold">Date dernière écheance</span>
                                        </div>
                                        <div class="vx-col w-full sm:w-4/6">
                                            <vs-input class="w-full" v-model="form.date_echeance_2"></vs-input>
<!--                                            <span v-if="lastDate">{{getDate(lastDate[0].date)}}</span>-->
                                            <span v-if="lastDate">{{lastDate}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row pb-6">
                                        <div class="vx-col w-full" v-if="echeances">
                                            <vs-table :data="echeances">
                                                <template slot="header">
                                                    <h4>Echéanciers</h4>
                                                </template>
                                                <template slot="thead">
                                                    <vs-th>numero ordre</vs-th>
                                                    <vs-th>date</vs-th>
                                                    <vs-th>montant</vs-th>
                                                    <vs-th>mois</vs-th>
                                                    <vs-th>ligne mois</vs-th>
                                                    <vs-th>ecart</vs-th>
                                                </template>
                                                <template slot-scope="{data}">
                                                    <vs-tr v-for="(item, index) in data" :key="index">
                                                        <vs-td :data="item.ordre">{{item.ordre}}</vs-td>
                                                        <vs-td :data="item.date">
                                                            <span>{{item.jour}}/</span>
                                                            <span>{{item.mois}}</span>
                                                            <span>{{item.annee}}</span>
                                                        </vs-td>
                                                        <vs-td :data="item.montant">{{item.montant | number('0,0', { thousandsSeparator: ' ' })}}</vs-td>
                                                        <vs-td :data="item.mois">{{item.mois}}</vs-td>
                                                        <vs-td :data="item.lignemois">{{item.lignemois}}</vs-td>
                                                        <vs-td :data="item.ecart">{{item.ecart}}</vs-td>
                                                    </vs-tr>
                                                </template>
                                            </vs-table>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="vx-row pt-6">
                            <div class="flex vx-col sm:w-5/6 w-full ml-auto">
                                <vs-button @click="$inertia.replace(route('clients'))" icon="replay" color="danger">Annuler</vs-button>
                                <vs-button :disabled="sending" @click="save" color="success" icon="save" class="mx-2">Enregistrer</vs-button>
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
    import * as moment from "moment";
    export default {
        metaInfo: {title: 'Formulaire Souscription'},
        layout: Layout,
        props: {
            client: Object,
            maisons: Array,
            flash: Object
        },
        data() {
            return {
                sending: false,
                selectedMaison: null,
                form: {
                    date_souscription: moment().format().slice(0,10),
                    apport_initial: null,
                    solde_initial: null,
                    client_id: this.client.id,
                    maison_id: null,
                    option_paiement: null,
                    ecart_paie: null,
                    date_echeance_1: moment().format().slice(0,10),
                    date_echeance_2: null,
                }
            }
        },
        computed: {
            apportInitial() {
                if (this.selectedMaison) {
                    let valeur = (this.selectedMaison.prix_unitaire * 35) /100;
                    return valeur;
                }
            },
            solde() {
                if (this.selectedMaison) {
                    let valeur = this.selectedMaison.prix_unitaire - this.apportInitial;
                    return valeur;
                }
            },
            echeances() {
                if (this.numLignePaie) {
                    let tableEcheance = [];
                    for (let i = 0; i < this.numLignePaie; i++) {
                        let ecart = parseInt(this.form.ecart_paie);
                        let ligneMois = (this.mois + i);
                        let ligneAnnee = this.annee;
                        let ordre = i + 1;
                        let ecartType =0;

                        if ((this.mois +i) > 12) {

                            ligneMois = (ligneMois -12) ;
                            ligneAnnee = ligneAnnee + 1;
                       }
                        if ((this.mois +i) > 24) {
                           ligneMois = (ligneMois -12);
                           ligneAnnee = ligneAnnee + 1;
                        }
                        if ((this.mois +i) > 36) {
                           ligneMois =  (ligneMois - 12);
                           ligneAnnee = ligneAnnee + 1;
                        }
                        if ((this.mois +i) > 48) {
                           ligneMois = (ligneMois - 12);
                           ligneAnnee = ligneAnnee + 1;
                        }
                        if ((this.mois +i) > 60) {
                            ligneMois = (ligneMois - 12);
                            ligneAnnee = ligneAnnee + 1;
                        }
                        if (ecart == 1) {
                            ecartType = 0;
                        }
                        if (ecart == 2) {
                            ecartType = 1;
                        }
                        if (ecart == 3) {
                            ecartType = 3;
                        }
                        tableEcheance.push({
                            'montant': this.solde / this.numLignePaie,
                            'date': `${ligneAnnee}-${ligneMois}-${this.jour}`,
                            'ordre': ordre,
                            'jour': this.jour,
                            'mois': ordre > 1 ? ligneMois + ecartType : ligneMois,
                            'lignemois': ligneMois,
                            'annee': ligneAnnee,
                            'ecart':  ecart,

                        })
                    }
                    return tableEcheance;

                }
            },
            mois() {
                    if (this.form.date_echeance_1) {
                        return parseInt(this.form.date_echeance_1.substr(5,2))
                    }
            },
            annee() {
                if(this.form.date_echeance_1) {
                    return parseInt(this.form.date_echeance_1.substr(0,4))
                }
            },
            jour() {
                if (this.form.date_echeance_1) {
                    return this.form.date_echeance_1.substr(8,2)
                }
            },
            numLignePaie() {
               if (this.form.option_paiement && this.form.ecart_paie) {
                   return this.form.option_paiement / this.form.ecart_paie;
               } else {
                   return 0;
               }
            },
            lastDate: {
                    get() {
                        if (typeof this.echeances != 'undefined' && this.echeances.length > 0) {
                            let last = this.echeances.slice(-1);
                            let obj = Object.assign({}, last);
                            this.form.date_echeance_2 = obj[0].date;
                            return obj[0].date;

                        } else {
                            return 0;
                        }
                    },
                set(val) {
                    if (typeof this.echeances != 'undefined' && this.echeances.length > 0) {
                        val = this.echeances.slice(-1);
                        let obj = Object.assign({}, val);
                        this.form.date_echeance_2 = obj[0].date;
                        return obj;
                    } else {
                        return 0;
                    }
                }

               }
        },
        methods: {
            selectedItem(val) {
                this.selectedMaison = val;
                this.form.maison_id = this.selectedMaison.id;
                this.form.apport_initial = this.apportInitial;
                this.form.solde_initial = this.solde;

            },
            save() {
                this.sending = true;
                this.$inertia.post(this.route('souscription.store'), this.form).then(() => {
                    this.sending = false;
                })
            },
            getDate(date) {
                return moment(date).format().slice(0,10)
            },
            getDateTable(date){
                return moment(date).format('DD/MM/YYYY').slice(0,10)
            }
        }
    }
</script>

<style scoped>

</style>
