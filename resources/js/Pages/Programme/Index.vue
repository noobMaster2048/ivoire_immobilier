<template>
    <div class="container mx-auto">
        <h1 class="mx-8 mb-8 font-bold text-3xl text-orange-500">
            Programmes
        </h1>
        <div class="container mx-auto mb-6 ml-8 flex justify-between items-center">
            <vs-button icon="add" @click="$inertia.replace(route('programme.create'))" color="success" class="float-right">
                <span>Ajouter</span>
                <span class="hidden md:inline">un programme</span>
            </vs-button>
        </div>
        <div>
            <vs-tabs>
                <vs-tab label="Programmes" icon="domain" @click="$inertia.replace(route('programmes'))"></vs-tab>
                <vs-tab label="Maisons" icon="account_balance" @click="$inertia.replace(route('maisons'))"></vs-tab>
                <vs-tab label="Utilisateurs" icon="account_circle" @click="$inertia.replace(route('users'))"></vs-tab>
            </vs-tabs>
        </div>
                <div class="container px-4 mx-auto border border-gray-300 rounded shadow-2xl overflow-hidden bg-white">
                    <vs-table pagination max-items="15" search :data="programmes" noDataText="Aucune donnée disponible">
                        <template slot="header">
                            <h3 class="text-blue-700 font-sans text-2xl">Programmes</h3>
                        </template>
                        <template slot="thead">
                            <vs-th>
                                <span class="text-base"> Code</span>
                            </vs-th>
                            <vs-th >
                                <span class="text-base">Structure</span>
                            </vs-th>
                            <vs-th>
                                <span class="text-base">Libelle</span>
                            </vs-th>
                            <vs-th>
                                <span class="text-base">Description</span>
                            </vs-th>
                            <vs-th></vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr :data="item" :key="item.id" v-for="item in data">
                                <vs-td :data="item.code">
                                    {{item.code}}
                                </vs-td>
                                <vs-td :data="item.structure">
                                    {{item.structure}}
                                </vs-td>
                                <vs-td :data="item.libelle">
                                    {{item.libelle}}
                                </vs-td>
                                <vs-td :data="item.description">
                                    {{item.description}}
                                </vs-td>
                                <vs-td>
                                    <div class="vx-row">
                                        <vs-button class="mx-2" color="success" size="small" icon="edit" type="border" @click="$inertia.replace(route('programme.edit', item.id))">Editer</vs-button>
                                        <vs-button class="mx-2" color="#f2135d" size="small" icon="delete_outline" type="border" @click="openDialog(item.id)">Supprimer</vs-button>

                                    </div>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
            </div>
        <vs-prompt title="Confirmation de suppression" color="danger" accept-text="Oui" cancel-text="Non" @accept="supprimer" :active.sync="activePrompt">
            <div class="text-center mx-auto">
                Voulez-vous supprimer ce programme ?
            </div>
        </vs-prompt>
    </div>
</template>
<script>
    import Layout from '@/Shared/layout';

    export default {
        metaInfo: {title: 'Liste des programmes'},
        layout: Layout,
        props: ['flash', 'programmes',],
        data() {
            return {
                selected: null,
                activePrompt: false,

            }
        },
        methods: {
            supprimer() {
                this.$inertia.delete(this.route('programme.delete', this.selected))
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
