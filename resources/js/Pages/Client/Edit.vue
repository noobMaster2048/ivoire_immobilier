<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('clients')">Clients</inertia-link>
                <span class="text-danger font-medium">/</span> Modification
            </h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card fixedHeight>
                    <div slot="header">
                        <h4 class="font-bold text-green-800">Formulaire client</h4>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="px-4">
                                <vs-avatar size="150px"></vs-avatar>
                            </div>
                            <div class="w-full">
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.nom" label="Nom" :danger="checkNom" danger-text="Le nom est obligatoire"></vs-input>
                                    </div>
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.prenom" label="Prénoms"></vs-input>
                                    </div>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.cni" label="Numéro CNI" :danger="checkCni" danger-text="Le numero de la CNI est obligatoire"></vs-input>
                                    </div>
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.profession" label="Profession"></vs-input>
                                    </div>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" type="date" v-model="form.date_naissance" label="Date de naissance"></vs-input>
                                    </div>
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.lieu_naissance" label="Lieu de naissance" :danger="checkLieu" danger-text="Le lieu de naissance est obligatoire"></vs-input>
                                    </div>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.tel_principal" label="Téléphone principal" :danger="checkTel" danger-text="Le téléphone principal est obligatoire"></vs-input>
                                    </div>
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.tel_secondaire" label="Téléphone secondaire"></vs-input>
                                    </div>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.reseau_principal" label="Réseau principal"></vs-input>
                                    </div>
                                    <div class="vx-col sm:w-1/2 mb-2">
                                        <vs-input class="w-full" v-model="form.reseau_secondaire" label="Réseau secondaire"></vs-input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="vx-row">
                                <div class="vx-col sm:w-1/3 mb-2">
                                    <vs-input class="w-full" v-model="form.banque" label="Banque"></vs-input>
                                </div>
                                <div class="vx-col sm:w-1/3 mb-2">
                                    <vs-input class="w-full" v-model="form.numero_compte" label="Numero de compte"></vs-input>
                                </div>
                                <div class="vx-col sm:w-1/3 mb-2">
                                    <vs-input class="w-full" v-model="form.email" label="Email"></vs-input>
                                </div>
                            </div>
                            <div class="vx-row">
                                <div class="vx-col sm:w-1/2 mb-2">
                                    <vs-input class="w-full" v-model="form.adresse" label="Adresse postale"></vs-input>
                                </div>
                                <div class="vx-col sm:w-1/2 mb-2">
                                    <vs-input class="w-full" v-model="form.residence" label="Résidence"></vs-input>
                                </div>
                            </div>
                            <div class="vx-row">
                                <div class="vx-col sm:w-1/2 mb-2">
                                    <vs-select class="w-full" v-model="form.parrain" label="Client envoyé par " autocomplete>
                                        <vs-select-item v-for="user in users" :key="user.id" :value="user.id" :text="user.nom"></vs-select-item>
                                    </vs-select>
                                </div>
                                <div class="vx-col sm:w-1/2 mb-2">
                                    <vs-textarea class="w-full" v-model="form.observations" label="Observations"></vs-textarea>
                                </div>
                            </div>
                        </div>

                        <div class="vx-row">
                            <div class="flex vx-col sm:w-2/3 w-full ml-24">
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
    export default {
        metaInfo: {title: 'Formulaire client'},
        layout: Layout,
        props: {
            client: Object,
            users: Array,
        },
        data() {
            return {
                sending: false,
                form: {
                    nom: this.client.nom,
                    prenom: this.client.prenom,
                    identifiant: this.client.identifiant,
                    statut: this.client.statut,
                    cni: this.client.cni,
                    profession: this.client.profession,
                    lieu_naissance: this.client.lieu_naissance,
                    date_naissance: this.client.date_naissance,
                    reseau_principal: this.client.reseau_principal,
                    reseau_secondaire: this.client.reseau_secondaire,
                    tel_principal: this.client.tel_principal,
                    tel_secondaire: this.client.tel_secondaire,
                    email: this.client.email,
                    banque: this.client.banque,
                    numero_compte: this.client.numero_compte,
                    adresse: this.client.adresse,
                    residence: this.client.residence,
                    observations: this.client.observations,
                    parrain: this.client.parrain,
                }
            }
        },
        computed: {
            checkNom() {
                if (this.$page.errors.nom) {
                    return true;
                } else {
                    return false;
                }
            },
            checkCni() {
                if (this.$page.errors.cni) {
                    return true;
                } else {
                    return false;
                }
            },
            checkLieu() {
                if (this.$page.errors.lieu_naissance) {
                    return true;
                } else {
                    return false;
                }
            },
            checkTel() {
                if (this.$page.errors.tel_principal) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        methods: {
            save() {
                this.sending = true;
                this.$inertia.put(this.route('client.update', this.client.id), this.form).then(() => {
                    this.sending = false;
                });
                this.sending = false;
            }
        }
    }
</script>

<style scoped>

</style>
