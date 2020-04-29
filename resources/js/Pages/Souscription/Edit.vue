<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link :href="route('clients')" class="text-danger">Client</inertia-link>
                <span class="text-danger font-medium">/</span>Modification
            </h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <vs-card>
                    <div slot="header">
                        <h3 class="con-vs-alert-success">Formulaire souscription</h3>
                    </div>
                    <div>
                        <div class="vx-row">
                            <div class="vx-col w-full">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <fieldset class="p-2">
                                            <legend>
                                                <h4 class="capitalize">client</h4>
                                            </legend>
                                            <div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">nom et prénoms</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">{{souscription.client.nom}} {{souscription.client.prenom}}</span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">contact</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">{{souscription.client.tel_principal}}</span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">n° de compte</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base uppercase font-medium">{{souscription.client.numero_compte}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div>
                                        <fieldset class="p-2">
                                            <legend>
                                                <h4 class="capitalize">soucription</h4>
                                            </legend>
                                            <div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full">
                                                        <vs-checkbox v-model="modifSouscription" color="success"> Modifier l'apport initial</vs-checkbox>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">date souscription</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">{{getDate(souscription.date_souscription)}}</span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">apport initial</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <div v-if="!modifSouscription">
                                                            <span class="text-color-base text-base capitalize font-medium">{{form.apport_initial | number('0,0', { thousandsSeparator: ' ' })}} frs</span>
                                                        </div>
                                                        <div v-if="modifSouscription">
                                                            <vs-input v-model="form.apport_initial" class="w-full" @input="getSoldeInitial"></vs-input>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">solde initial</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">{{form.solde_initial | number('0,0', { thousandsSeparator: ' ' })}} frs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div>
                                        <fieldset class="p-2">
                                            <legend><h4 class="capitalize">maison</h4></legend>
                                            <div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full">
                                                        <vs-checkbox v-model="modifMaison" color="success"> Modifier le prix de la maison</vs-checkbox>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">standing</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">{{souscription.maison.standing}}</span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">superficie</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">{{souscription.maison.superficie}} m²</span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">prix unitaire</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <div v-if="!modifMaison">
                                                            <span class="text-color-base text-base capitalize font-medium">{{form.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} Frs</span>
                                                        </div>
                                                        <div v-if="modifMaison">
                                                            <vs-input v-model="form.prix_unitaire" class="w-full" @input="getSoldeInitial"></vs-input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div>
                                        <fieldset class="p-2">
                                            <legend><h4 class="capitalize">écheanciers</h4></legend>
                                            <div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">option de paiement</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <vs-select v-model="form.option_paiement" class="w-full" autocomplete @input="echeanciers">
                                                            <vs-select-item value="12" text="12 Mois"></vs-select-item>
                                                            <vs-select-item value="24" text="24 Mois"></vs-select-item>
                                                            <vs-select-item value="36" text="36 Mois"></vs-select-item>
                                                            <vs-select-item value="48" text="48 Mois"></vs-select-item>
                                                            <vs-select-item value="60" text="60 Mois"></vs-select-item>
                                                        </vs-select>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">ecart de paiement</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <vs-select v-model="form.ecart_paie" class="w-full" autocomplete @input="echeanciers">
                                                            <vs-select-item value="1" text="1 Mois"></vs-select-item>
                                                            <vs-select-item value="2" text="2 Mois"></vs-select-item>
                                                            <vs-select-item value="3" text="3 Mois"></vs-select-item>
                                                        </vs-select>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">date premiere echeance</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <vs-input v-model="form.date_echeance_1" class="w-full" type="date"></vs-input>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base capitalize font-medium">date dernière echeance</span>
                                                    </div>
                                                    <div class="vx-col w-full sm:w-1/2">
                                                        <span class="text-color-base text-base font-medium">{{getDate(form.date_echeance_2)}}</span>
                                                    </div>
                                                </div>
                                                <div class="vx-row pb-6">
                                                    <div class="vx-col w-full">
                                                        <vs-table :data="form.echeanciers" noDataText="Aucune donnée disponible" pagination max-items="10">
                                                            <template slot="header">
                                                                <h3 class="con-vs-alert-success capitalize">écheanciers</h3>
                                                            </template>
                                                            <template slot="thead">
                                                                <vs-th><span class="capitalize">ordre</span></vs-th>
                                                                <vs-th><span class="capitalize">date</span></vs-th>
                                                                <vs-th><span class="capitalize">montant</span></vs-th>
                                                            </template>
                                                            <template slot-scope="{data}">
                                                                <vs-tr v-for="item in data" :key="item.id" :data="item">
                                                                    <vs-td :data="item.numero_ordre">{{item.numero_ordre}}</vs-td>
                                                                    <vs-td :data="item.numero_ordre">{{item.mois}}</vs-td>
                                                                    <vs-td :data="item.montant">{{item.montant}}</vs-td>
                                                                </vs-tr>
                                                            </template>
                                                        </vs-table>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
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
    import * as moment from "moment";
    export default {
        metaInfo: {title: 'Formulaire Souscription'},
        layout: Layout,
        props: {
            flash: Object,
            souscription: Object,
        },
        data() {
            return {
                sending: false,
                modifMaison: false,
                modifSouscription: false,
                form: {
                    date_souscription: this.souscription.date_souscription,
                    apport_initial: this.souscription.apport_initial,
                    solde_initial: this.souscription.solde_initial,
                    client_id: this.souscription.client.id,
                    maison_id: this.souscription.maison.id,
                    option_paiement: this.souscription.option_paiement,
                    ecart_paie: this.souscription.ecart_paie,
                    date_echeance_1: this.souscription.date_echeance_1,
                    date_echeance_2: this.souscription.date_echeance_2,
                    echeanciers: this.souscription.echeanciers,
                    prix_unitaire: this.souscription.maison.prix_unitaire,
                }
            }
        },
        computed: {
            numLignePaie() {
                if (this.form.ecart_paie && this.form.option_paiement) {
                    return this.form.option_paiement / this.form.ecart_paie;
                } else {
                    return 0;
                }
            },
            getSoldeInitial() {
               return this.form.solde_initial = this.form.prix_unitaire - this.form.apport_initial;
            },

            echeanciers() {
                if (this.numLignePaie) {
                    let tableEcheance = [];
                    for (let i = 0; i < this.numLignePaie; i++) {
                        let ligneMois = this.mois + i;
                        let ligneAnnee = this.annee;
                        if ((this.mois +i) > 12) {
                            ligneMois = ligneMois -12;
                            ligneAnnee = ligneAnnee + 1;
                        }
                        if ((this.mois +i) > 24) {
                            ligneMois = ligneMois -12;
                            ligneAnnee = ligneAnnee + 1
                        }
                        if ((this.mois +i) > 36) {
                            ligneMois =  ligneMois - 12;
                            ligneAnnee = ligneAnnee + 1;
                        }
                        if ((this.mois +i) > 48) {
                            ligneMois = ligneMois - 12;
                            ligneAnnee = ligneAnnee + 1;
                        }
                        if ((this.mois +i) > 60) {
                            ligneMois = ligneMois - 12;
                            ligneAnnee = ligneAnnee + 1;
                        }
                        tableEcheance.push({
                            'montant': (this.form.prix_unitaire - this.form.apport_initial) / this.numLignePaie,
                            //'date': `${ligneAnnee}-${ligneMois}-${this.jour}`,
                            'jour': this.jour,
                            'mois': ligneMois,
                            'annee': ligneAnnee,
                            'numero_ordre': i + 1,
                        })
                    }
                    this.form.echeanciers = null;
                    this.form.echeanciers = tableEcheance;
                    return this.form.echeanciers;
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
            }

        },
        methods: {
            save() {
                this.sending = true;
                this.$inertia.put(this.route('souscription.update', this.souscription.id), this.form).then(() => {
                    this.sending = false;
                })
            },
            getDate(date) {
                return moment(date).format('DD/MM/YYYY');
            },
            getDateTable(jour, mois, annee) {
                return moment().format('DD/MM/YYYY')
            },
            ecartChange() {
                this.sending = !this.sending;
            },
            optionChange() {

            },
            getApportInitial() {
                this.form.apport_initial = (this.form.prix_unitaire * 35) / 100
            }

        }
    }
</script>

<style scoped>

</style>
