
<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('maisons')">Maisons</inertia-link>
                <span class="text-danger font-medium">/</span> Modification
            </h1>
        </div>

        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card fixedHeight>
                    <div slot="header">
                        <h4 class="font-bold text-grenn-800">Formulaire maison</h4>
                    </div>
                    <div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Dénomination</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.denomination" class="w-full md:w-2/3" :danger="checkdenomination" :danger-text="errordenomination"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Standing</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.standing" class="w-full md:w-2/3" :danger="checkstanding" :danger-text="errorstanding"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Superficie</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.superficie" class="w-full md:w-2/3" :danger="checksuperficie" :danger-text="errorsuperficie"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Prix unitaire</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.prix_unitaire" class="w-full md:w-2/3" :danger="checkprix_unitaire" danger-text="Le prix est obligatoire"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Programme</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-select v-model="form.programme_id" autocomplete class="w-full md:w-2/3" :danger="checkprogramme_id" dandger-text="Le programme est obligatoire">
                                    <vs-select-item v-for="item in progs" :key="item.id" :value="item.id" :text="item.libelle"> </vs-select-item>
                                </vs-select>
                            </div>
                        </div>
                        <div class="vx-row">
                            <div class="flex vx-col sm:w-5/6 w-full ml-auto">
                                <vs-button @click="$inertia.replace(route('maisons'))" icon="replay" color="danger">Annuler</vs-button>
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
        metaInfo: {title: 'Formulaire maison'},
        layout: Layout,
        props: ['progs', 'maison'],
        data() {
            return {
                sending: false,
                form: {
                    denomination: this.maison.denomination,
                    standing: this.maison.standing,
                    superficie: this.maison.superficie,
                    prix_unitaire: this.maison.prix_unitaire,
                    programme_id: this.maison.programme_id,
                }
            }
        },
        methods: {
            save() {
                this.sending = true;
                this.$inertia.put(this.route('maison.update', this.maison.id), this.form).then(() => {
                    this.Sending = false;
                });
                this.sending = false;
            }
        },
        computed: {
            checkdenomination() {
                if (this.$page.errors.denomination) {
                    return true
                } else {
                    return false
                }
            },
            errordenomination() {
                if (this.$page.errors.denomination) {
                    return this.$page.errors.denomination[0]
                }
            },
            checkstanding() {
                if (this.$page.errors.standing) {
                    return true
                } else {
                    return false
                }
            },
            errorstanding() {
                if (this.$page.errors.standing) {
                    return this.$page.errors.standing[0]
                }
            },
            checksuperficie() {
                if (this.$page.errors.superficie) {
                    return true
                } else {
                    return false
                }
            },
            errorsuperficie() {
                if (this.$page.errors.superficie) {
                    return this.$page.errors.superficie[0]
                }
            },
            checkprix_unitaire() {
                if (this.$page.errors.prix_unitaire) {
                    return true
                } else {
                    return false
                }
            },
            checkprogramme_id() {
                if (this.$page.errors.programme_id) {
                    return true
                } else {
                    return false
                }
            },
        }
    }
</script>
