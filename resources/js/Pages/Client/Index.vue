<template>
    <div class="container mx-auto">
        <h1 class="mx-8 mb-8 font-bold text-3xl text-orange-500">
            Clients
        </h1>
        <div class="container flex items-center mx-auto ml-8 mb-6">
            <vs-button size="small" icon="add" color="success" @click="$inertia.replace(route('client.create'))" class="mx-4">
                <span>Ajouter</span>
                <span class="hidden md:inline">un client</span>
            </vs-button>
            <vs-button size="small" icon="edit" color="success" @click="$inertia.replace(route('client.edit', selected.id))" class="mx-4">
                <span>Modifier</span>
                <span class="hidden md:inline">le client</span>
            </vs-button>
            <a href="/clients/export">
                <vs-button size="small" icon="get_app" class="mx-4"> Exporter</vs-button>
            </a>
        </div>
        <div class="flex">
            <div class="w-full md:w-1/2"><div class="container px-4 mx-auto border border-gray-300 rounded shadow-2xl overflow-hidden">
                <vs-table pagination max-items="15" search :data="clients" noDataText="Aucune donnée disponible">
                    <template slot="header">
                        <h3 class="text-blue-700 font-sans text-2xl">Clients</h3>
                    </template>
                    <template slot="thead">
                        <vs-th>
                            <span class="text-base"> Nom</span>
                        </vs-th>
                        <vs-th >
                            <span class="text-base">Prénoms</span>
                        </vs-th>
                        <vs-th>Souscription</vs-th>
                        <vs-th></vs-th>
                    </template>
                    <template slot-scope="{data}">
                        <vs-tr :data="item" :key="item.id" v-for="item in data">
                            <vs-td :data="item.nom">
                                {{item.nom}}
                            </vs-td>
                            <vs-td :data="item.prenom">
                                {{item.prenom}}
                            </vs-td>
                            <vs-td :data="item.souscription">
                                <div v-if="item.souscription">
                                    <vs-chip transparent color="success">Valide</vs-chip>
                                </div>
                                <div v-else>
                                    <vs-chip transparent color="warning">Non Valide</vs-chip>
                                </div>
                            </vs-td>
                            <vs-td>
                                <div class="vx-row">
                                    <vs-button class="mx-2" icon="visibility" color="success" size="small" type="border" @click="selectedItem(item)">Selectionner</vs-button>
                                    <vs-button class="mx-2" color="#f2135d" size="small" icon="delete_outline" type="border" @click="openDialog(item.id)">Supprimer</vs-button>
                                </div>
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
            </div></div>
            <div class="w-full md:w-1/2">
                <div class="vx-row">
                    <div class="vx-col w-full mb-6">
                        <vs-card fixedHeight v-if="selected">
                            <div slot="header">
                                <div class="flex justify-end" v-if="checkSouscription">
                                    <vs-button @click="$inertia.replace(route('souscription.edit',selected.souscription.id))">Modifier souscription</vs-button>
                                </div>
                            </div>
                            <div>
                                <div class="bg-green-500 px-4">
                                    <div class="flex flex-wrap">
                                        <div class="w-full">
                                            <span class="text-orange-500 text-2xl">{{selected.nom}} {{selected.prenom}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2">
                                            <span class="block text-yellow-500 uppercase text-base">Profession</span>
                                            <span class=" block text-white text-base">{{selected.profession}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="block text-yellow-500 uppercase text-base">Banque</span>
                                            <span class="block text-white text-base uppercase">{{selected.banque}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="my-4">
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2 w-full">
                                            <span class="text-base font-semibold uppercase">Date de naissance</span>
                                            <span class="text-base text-blue-500">{{selected.date_naissance}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="text-base font-semibold uppercase">Telephone 1</span>
                                            <span class="text-base text-blue-500">{{selected.tel_principal}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2 w-full">
                                            <span class="text-base font-semibold uppercase">Lieu de naissance</span>
                                            <span class="text-base text-blue-500">{{selected.lieu_naissance}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="text-base font-semibold uppercase">Telephone 2</span>
                                            <span class="text-base text-blue-500">{{selected.tel_secondaire}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2 w-full">
                                            <span class="text-base font-semibold uppercase">Numero CNI</span>
                                            <span class="text-base text-blue-500">{{selected.cni}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="text-base font-semibold uppercase">Réseau principal</span>
                                            <span class="text-base text-blue-500">{{selected.reseau_principal}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="my-4">
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2 w-full">
                                            <span class="text-base font-semibold uppercase">Email</span>
                                            <span class="text-base text-blue-500">{{selected.email}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="text-base font-semibold uppercase">Numero compte</span>
                                            <span class="text-base text-blue-500">{{selected.numero_compte}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2 w-full">
                                            <span class="text-base font-semibold uppercase">Lieu de résidence</span>
                                            <span class="text-base text-blue-500">{{selected.residence}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="text-base font-semibold uppercase">Adresse postale</span>
                                            <span class="text-base text-blue-500">{{selected.adresse}}</span>
                                        </div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col sm:w-1/2 w-full">
                                            <span class="text-base font-semibold uppercase">Observations</span>
                                            <span class="text-base text-blue-500">{{selected.observations}}</span>
                                        </div>
                                        <div class="vx-col sm:w-1/2">
                                            <span class="text-base font-semibold uppercase">Envoyé par</span>
                                            <span class="text-base text-blue-500">{{selected.parrain.nom}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="my-4">
                                    <div class="flex flex-wrap justify-around">
                                        <vs-button :disabled="checkSouscription" icon="subscriptions" @click="$inertia.replace(route('souscription.create',selected.id))">Souscription</vs-button>
                                        <vs-button :disabled="!checkSouscription" icon="local_atm" @click="$inertia.replace(route('reglement.create', selected.id))">Reglement</vs-button>
                                    </div>
                                </div>
                            </div>
                        </vs-card>
                    </div>
                </div>
            </div>
        </div>

        <vs-prompt title="Confirmation de suppression" color="danger" accept-text="Oui" cancel-text="Non" @accept="supprimer" :active.sync="activePrompt">
            <div class="text-center mx-auto">
                Voulez-vous supprimer ce client ?
            </div>
        </vs-prompt>

    </div>
</template>
<script>
    import Layout from '@/Shared/layout';

    export default {
        metaInfo: {title: 'Liste des clients'},
        layout: Layout,
        props: ['flash', 'clients'],
        data: () => ({
            selected: null,
            item: null,
            activePrompt: false,
            activePromptClient: false,
            form: {
                nom: null,
                prenom: null,
                identifiant: null,
                statut: null,
                cni: null,
                profession: null,
                lieu_naissance: null,
                date_naissance: null,
                reseau_principal: null,
                reseau_secondaire: null,
                tel_principal: null,
                tel_secondaire: null,
                email: null,
                banque: null,
                numero_compte: null,
                adresse: null,
                residence: null,
                observations: null,
                parrain: null,
            }
        }),
        methods: {
            supprimer() {
                this.$inertia.delete(this.route('client.delete', this.item))
            },
            openDialog(val) {
                this.item = val;
                this.activePrompt = true;
            },
            selectedItem(val) {
                this.selected = val;
            },

        },
        computed: {
            checkSouscription() {
                if (this.selected.souscription) {
                    return true
                } else {
                    return false
                }
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
