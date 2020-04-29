<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('contrats.existant')">Contrats</inertia-link>
                <span class="text-danger font-medium">/</span> Modification
            </h1>
        </div>
        <div>
            <div class="vx-row">
                <div class="vx-col w-full">
                    <vs-card fixedHeight>
                        <div slot="header">
                            <h3 class="font-bold text-green-800">Formulaire contrat</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <fieldset>
                                    <legend>
                                        <h3>Bénéficiare</h3>
                                    </legend>
                                    <div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Monsieur / Madame</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{fullName}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Profession</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.client.profession}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Domicile</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.client.residence}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Date de naissance</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{getDate(contrat.client.date_naissance)}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Lieu de naissance</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.client.lieu_naissance}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">N° de la pièce</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg uppercase">{{contrat.client.cni}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Téléphone</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.client.tel_principal}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Epoux (se) de</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.epoux" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Né le</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.date_naissance" type="date" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Ayant droit</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.ayant" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div>
                                <fieldset>
                                    <legend>
                                        <h3>Désignation maison</h3>
                                    </legend>
                                    <div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Programme ou cité</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.programme.libelle}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Type de maison</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.maison.standing}}</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Superficie du terrain</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.maison.superficie}} m²</span>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Surface utile</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                               <vs-input v-model="form.surface_utile" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Salon</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.salon" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">salle à manger</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.salle_manger" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Nombre de chambre</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.nb_chambre" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Terrasse</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <vs-input v-model="form.terrasse" class="w-full"></vs-input>
                                            </div>
                                        </div>
                                        <div class="vx-row pb-6 px-2">
                                            <div class="vx-col w-full sm:w-2/6">
                                                <span class="text-color-base text-lg font-bold">Prix de l'ouvrage</span>
                                            </div>
                                            <div class="vx-col w-full sm:w-4/6">
                                                <span class="text-color-base text-lg">{{contrat.client.souscription.maison.prix_unitaire | number('0,0', { thousandsSeparator: ' ' })}} Frs CFA</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="vx-row pt-4">
                            <div class="vx-col flex">
                                <vs-button color="danger" icon="replay" @click="$inertia.replace(route('contrats.existant'))"> Annuler</vs-button>
                                <vs-button :disabled="sending" @click="save" color="success" icon="save" class="mx-2">Générer le contrat</vs-button>
                            </div>
                        </div>
                    </vs-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import * as moment from 'moment';
    export default {
        metaInfo: { title: 'Formulaire contrat'},
        layout: Layout,
        props: {
            contrat: Object,
        },
        data() {
            return {
                sending: false,
                form: {
                    epoux: this.contrat.epoux,
                    client_id: this.contrat.client.id,
                    maison_id: this.contrat.client.souscription.maison.id,
                    programme_id: this.contrat.programme.id,
                    date_naissance: this.contrat.date_naissance,
                    ayant: this.contrat.ayant,
                    surface_utile: this.contrat.surface_utile,
                    salon: this.contrat.salon,
                    baie: this.contrat.baie,
                    nb_chambre: this.contrat.nb_chambre,
                    salle_manger: this.contrat.salle_manger,
                    terrasse: this.contrat.terrasse,

                }
            }
        },
        computed: {
            fullName() {
                return this.contrat.client.nom + " " + this.contrat.client.prenom;
            },
        },
        methods: {
            save() {
                this.sending = true;
                this.$inertia.put(this.route('contrat.update', this.contrat.id), this.form).then(()=> {
                    this.sending = false;
                });
                this.sending = false;
            },
            getDate(date) {
                return moment(date).format('DD/MM/YYYY');
            }
        }
    }
</script>

<style scoped>

</style>
