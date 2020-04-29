<template>
    <div class="container mx-auto">
        <h1 class="mx-8 mb-8 font-bold text-3xl text-orange-500"> Maisons</h1>
        <div class="container mx-auto mb-6 ml-8 flex justify-between items-center">
            <vs-button icon="add" @click="$inertia.replace(route('maison.create'))" color="success" class="float-right">
                <span>Ajouter</span>
                <span class="hidden md:inline">une maison</span>
            </vs-button>
        </div>

        <div>
            <vs-tabs>
                <vs-tab label="Programmes" icon="domain" @click="$inertia.replace(route('programmes'))"></vs-tab>
                <vs-tab label="Maisons" icon="account_balance" @click="$inertia.replace(route('maisons'))"></vs-tab>
                <vs-tab label="Utilisateurs" icon="account_circle" @click="$inertia.replace(route('users'))"></vs-tab>
            </vs-tabs>
        </div>

                <div class="container px-4 mx-auto border border-gray-300 rounded-lg shadow-2xl overflow-x-auto bg-white">
                    <vs-table pagination max-items="15" search :data="maisons" noDataText="Aucune donnée disponibe">
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
                            <vs-th>
                                <span class="text-base">Superficie</span>
                            </vs-th>
                            <vs-th>
                                <span class="text-base">Prix unitaire</span>
                            </vs-th>
                            <vs-th>
                                <span class="text-base">Programme</span>
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
                                    {{item.superficie}}
                                </vs-td>
                                <vs-td :data="item.prix_unitaire">
                                    {{item.prix_unitaire}}
                                </vs-td>
                                <vs-td :data="item.programme">
                                    <div v-if="item.programme">
                                        {{item.programme.code}}
                                    </div>
                                </vs-td>
                                <vs-td>
                                    <div class="vx-row">
                                        <vs-button class="mx-2" size="small" color="success" icon="edit" type="border" @click="$inertia.replace(route('maison.edit', item.id))">Editer</vs-button>
                                        <vs-button class="mx-2" size="small" color="#f2135d" icon="delete_outline" type="border" @click="openDialog(item.id)">Supprimer</vs-button>

                                    </div>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </div>


        <vs-prompt title="Confirmation de suppression" color="danger" accept-text="Oui" cancel-text="Non" @accept="supprimer" :active.sync="activePrompt">
            <div class="text-center mx-auto">
                Voulez-vous supprimer cette maison ?
            </div>
        </vs-prompt>
    </div>
</template>

<script>
    import Layout from '@/Shared/layout';

    export default {
        metaInfo: {title: 'Liste des maisons'},
        layout: Layout,
        props: ['flash', 'maisons', 'progs'],
        data() {
            return {
                selected: null,
                activePrompt: false,

            }
        },
        methods: {
            supprimer() {
                this.$inertia.delete(this.route('maison.delete', this.selected))
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

<style scoped>

</style>
