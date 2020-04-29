<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('programmes')">Programmes</inertia-link>
                <span class="text-danger font-medium">/</span> Création
            </h1>
        </div>

        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card fixedHeight>
                    <div slot="header">
                        <h4 class="font-bold text-green-800">Formulaire programme</h4>
                    </div>
                    <div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Code</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.code" class="w-full md:w-2/3" :danger="checkcode" :danger-text="errorcode"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Structure</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.structure" class="w-full md:w-2/3" :danger="checkstruct" :danger-text="errorstruct"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Libelle</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.libelle" class="w-full md:w-2/3" :danger="checklib" :danger-text="errorlib"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Description</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-textarea v-model="form.description" class="w-full md:w-2/3"></vs-textarea>
                            </div>
                        </div>
                        <div class="vx-row">
                            <div class="flex vx-col sm:w-5/6 w-full ml-auto">
                                <vs-button @click="$inertia.replace(route('programmes'))" icon="replay" color="danger">Annuler</vs-button>
                                <vs-button id="loading-button" ref="loadingButton" :disabled="sending" @click="save" color="success" icon="save" class="mx-2">Enregistrer</vs-button>
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
        metaInfo: {title: 'Formulaire programme'},
        layout: Layout,
        data() {
            return {
                sending: false,
                form: {
                    code: null,
                    structure: null,
                    libelle: null,
                    description: null,
                }
            }
        },
        methods: {
            save() {
                this.sending = true;
                this.$vs.loading({
                   // background: 'success',
                    color: '#fff',
                    container: '#loading-button',
                    scale: 0.45
                })
                this.$inertia.post(this.route('programme.store'), this.form).then(() => {
                    this.sending = false;
                    this.$vs.loading.close('#loading-button')
                });
                this.sending = false;
            }
        },
        computed: {
            checkcode() {
                if (this.$page.errors.code) {
                    return true
                } else {
                    return false
                }
            },
            errorcode() {
                if (this.$page.errors.code) {
                    return this.$page.errors.code[0]
                }
            },
            checkstruct() {
                if (this.$page.errors.structure) {
                    return true
                } else {
                    return false
                }
            },
            errorstruct() {
                if (this.$page.errors.structure) {
                    return this.$page.errors.structure[0]
                }
            },
            checklib() {
                if (this.$page.errors.libelle) {
                    return true
                } else {
                    return false
                }
            },
            errorlib() {
                if (this.$page.errors.libelle) {
                    return this.$page.errors.libelle[0]
                }
            }
        }
    }
</script>
