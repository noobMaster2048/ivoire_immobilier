<template>
    <div class="container mx-auto">
        <div>
            <h1 class="mx-8 mb-8 font-bold text-3xl">
                <inertia-link class="text-danger" :href="route('users')">Utilisateurs</inertia-link>
                <span class="text-danger font-medium">/</span> Modification
            </h1>
        </div>

        <div class="vx-row">
            <div class="vx-col w-full mb-6">
                <vs-card fixedHeight>
                    <div slot="header">
                        <h4 class="font-bold text-green-800">Formulaire utilisateur</h4>
                    </div>
                    <div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Login</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.login" class="w-full md:w-2/3" :danger="checklogin" :danger-text="errorlogin"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Nom</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.nom" class="w-full md:w-2/3"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Adresse Email</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.email" class="w-full md:w-2/3" :danger="checkemail" :danger-text="erroremail"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row pb-6">
                            <div class="vx-col w-full sm:w-1/6">
                                <span class="text-lg">Mot de passe</span>
                            </div>
                            <div class="vx-col w-full sm:w-5/6">
                                <vs-input v-model="form.password" type="password" class="w-full md:w-2/3" :danger="checkpassword" :danger-text="errorpassword"></vs-input>
                            </div>
                        </div>
                        <div class="vx-row">
                            <div class="flex vx-col sm:w-5/6 w-full ml-auto">
                                <vs-button @click="$inertia.replace(route('users'))" icon="replay" color="danger">Annuler</vs-button>
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
        metaInfo: {title: 'Formulaire utilisateur'},
        layout: Layout,
        props: ['user'],
        data() {
            return {
                sending: false,
                form: {
                    login: this.user.login,
                    nom: this.user.nom,
                    email: this.user.email,
                    password: this.user.password,
                }
            }
        },
        methods: {
            save() {
                this.sending = true;
                this.$inertia.put(this.route('user.update', this.user.id), this.form).then(() => {
                    this.Sending = false;
                });
                this.sending = false;
            }
        },
        computed: {
            checklogin() {
                if (this.$page.errors.login) {
                    return true
                } else {
                    return false
                }
            },
            errorlogin() {
                if (this.$page.errors.login) {
                    return this.$page.errors.login[0]
                }
            },
            checkemail() {
                if (this.$page.errors.email) {
                    return true
                } else {
                    return false
                }
            },
            erroremail() {
                if (this.$page.errors.email) {
                    return this.$page.errors.email[0]
                }
            },
            checkpassword() {
                if (this.$page.errors.password) {
                    return true
                } else {
                    return false
                }
            },
            errorpassword() {
                if (this.$page.errors.password) {
                    return this.$page.errors.password[0]
                }
            }
        }
    }
</script>
