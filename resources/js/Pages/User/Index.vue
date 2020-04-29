<template>
    <div class="container mx-auto">
        <h1 class="mx-8 mb-8 font-bold text-3xl text-orange-500">
            Utilisateurs
        </h1>
        <div class="container mx-auto mb-6 ml-8 flex justify-between items-center">
            <vs-button icon="add" @click="$inertia.replace(route('user.create'))" color="success" class="float-right">
                <span>Ajouter</span>
                <span class="hidden md:inline">un utilisateur</span>
            </vs-button>
        </div>

        <div>
            <vs-tabs>
                <vs-tab label="Programmes" icon="domain" @click="$inertia.replace(route('programmes'))"></vs-tab>
                <vs-tab label="Maisons" icon="account_balance" @click="$inertia.replace(route('maisons'))"></vs-tab>
                <vs-tab label="Utilisateurs" icon="account_circle" @click="$inertia.replace(route('users'))"></vs-tab>
            </vs-tabs>
        </div>

                <div class="container px-4 mx-auto border border-gray-300 rounded shadow-2xl overflow-hidden">
                    <vs-table pagination max-items="15" search :data="users" noDataText="Aucune donnée disponible">
                        <template slot="header">
                            <h3 class="text-blue-700 font-sans text-2xl uppercase">Utilisateurs</h3>
                        </template>
                        <template slot="thead">
                            <vs-th>
                                <span class="text-base"> Login</span>
                            </vs-th>
                            <vs-th >
                                <span class="text-base">Nom</span>
                            </vs-th>
                            <vs-th>
                                <span class="text-base">Email</span>
                            </vs-th>

                            <vs-th></vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                <vs-td :data="item.login">
                                    {{item.login}}
                                </vs-td>
                                <vs-td :data="item.nom">
                                    {{item.nom}}
                                </vs-td>
                                <vs-td :data="item.email">
                                    {{item.email}}
                                </vs-td>
                                <vs-td>
                                    <div class="vx-row">
                                        <vs-button class="mx-2" color="success" size="small" icon="edit" type="border" @click="$inertia.replace(route('user.edit', item.id))">Editer</vs-button>
                                        <vs-button class="mx-2" color="#f2135d" size="small" icon="delete_outline" type="border" @click="openDialog(item.id)">Supprimer</vs-button>

                                    </div>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
        </div>

        <vs-prompt title="Confirmation de suppression" color="danger" accept-text="Oui" cancel-text="Non" @accept="supprimer" :active.sync="activePrompt">
            <div class="text-center mx-auto">
                Voulez-vous supprimer cet utilisateur ?
            </div>
        </vs-prompt>
    </div>
</template>
<script>
    import Layout from '@/Shared/layout';

    export default {
        metaInfo: {title: 'Liste des utilisateurs'},
        layout: Layout,
        props: ['flash', 'users'],
        data() {
            return {
                selected: null,
                activePrompt: false,

            }
        },
        methods: {
            supprimer() {
                this.$inertia.delete(this.route('user.delete', this.selected))
            },
            openDialog(val) {
                this.selected = val;
                this.activePrompt = true;
            },
        },
        mounted() {
            if (this.flash.success) {
                this.$vs.notify({title:'Message de succès', text: this.flash.success, color: '#17c964', time: 5000, position: 'top-right', icon: 'mail'})
            }

            if(this.flash.error)  {
                this.$vs.notify({title:'Message de succès', text: this.flash.error, color: '#f2135d', time: 5000, position: 'top-right', icon: 'mail'})
            }

        }

    }
</script>
