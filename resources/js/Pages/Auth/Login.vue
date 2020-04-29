<template>
    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vs-card fixedHeight>
                <div class="full-page-bg-color">
                    <div class="vx-row no-gutter justify-center items-center">
                        <div class="vx-col hidden lg:block lg:w-1/2">
                            <img :src="'/assets/images/logo_ivoire.jpg'" alt="login" class="mx-auto h-64 w-full object-fill object-center">
                            <h2 class="text-center text-warning">Ivoire construction</h2>
                        </div>

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                            <div class="px-8 pt-8 login-tabs-container">
                                <div class="vx-card__title mb-">
                                    <h4 class="mb-4 text-success text-center text-3xl">Connexion</h4>
                                    <vs-alert :active="flash.error" color="danger">
                                        <div>{{flash.error}}</div>
                                    </vs-alert>
                                    <p class="text-xl">Bienvenue, S'il vous plaît veuillez vous connecter.</p>
                                </div>
                                <div>
                                    <vs-input v-model="form.login" icon="person" class="w-full my-8" label-placeholder="Login"></vs-input>

                                    <vs-input v-model="form.password" type="password" icon="https" class="w-full my-8" label-placeholder="Mot de passe"></vs-input>
                                    <div class="flex flex-wrap justify-between mb-3 my-5">
                                        <vs-button @click="doLogin">Se connecter</vs-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </vs-card>
        </div>
    </div>
</template>

<script>
    export default {
        metaInfo: {title: 'Page connexion'},
        props: ['flash'],
        data() {
            return {
                sending: false,
                form: {
                    login: null,
                    password: null,
                }
            }
        },
        methods: {
            doLogin() {
                this.sending = true;
                this.$inertia.post(this.route('connexion'), {
                    login: this.form.login,
                    password: this.form.password,
                }).then(() =>{
                    this.sending = false;
                })
            }
        },
        mounted() {
            if (this.flash.success) {
                this.$vs.notify({title:'Message de succès', text: this.flash.success, color: '#17c964', time: 5000, position: 'top-right', icon: 'mail'})
            }
            if(this.flash.error)  {
                this.$vs.notify({title:'Message erreur', text: this.flash.error, color: '#f2135d', time: 5000, position: 'top-right', icon: 'mail'})
            }

        }
    }
</script>

<style scoped>
    .vs-con-input-label {
        width: auto;
    }
</style>
