<template>
    <div class="container mx-auto">
        <div class="m-4">
            <h3>Liste des contrats crées</h3>
        </div>
        <div class="flex items-center container mx-auto">

            <vs-button class="mx-4" @click.prevent="$inertia.replace(route('contrat.pdf'))">Afficher tous les contrats</vs-button>

            <vs-button class="mx-4" @click="$inertia.replace(route('contrats.index'))">Ajouter un contrat</vs-button>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <div class="shadow-2xl rounded overflow-hidden border-gray-300 border container px-2">
                    <vs-table :data="contrats" search max-items="15" pagination noDataText="Aucune donnée disponible">
                        <template slot="thead">
                            <vs-th>Nom</vs-th>
                            <vs-th>profession</vs-th>
                            <vs-th>Domicile</vs-th>
                            <vs-th>Date de naissance</vs-th>
                            <vs-th>Lieu de naissance</vs-th>
                            <vs-th>N° de la CNI</vs-th>
                            <vs-th></vs-th>
                        </template>
                        <template slot-scope="{data}">
                            <vs-tr :data="item" v-for="item in data" :key="item.id">
                                <vs-td :data="item.client.nom">{{item.client.nom}}</vs-td>
                                <vs-td :data="item.client.profession">{{item.client.profession}}</vs-td>
                                <vs-td :data="item.client.residence">{{item.client.residence}}</vs-td>
                                <vs-td :data="item.client.date_naissance">{{formatDate(item.client.date_naissance)}}</vs-td>
                                <vs-td :data="item.client.lieu_naissance">{{item.client.lieu_naissance}}</vs-td>
                                <vs-td :data="item.client.cni">{{item.client.cni}}</vs-td>
                                <vs-td>
                                    <div class="vx-row">
                                        <vs-button class="mx-2" color="success" size="small" icon="edit" type="border" @click="$inertia.replace(route('contrat.edit', item.id))">Modifier</vs-button>
                                        <vs-button class="mx-2" color="#f2135d" size="small" icon="delete_outline" type="border" @click="openDialog(item.id)">Supprimer</vs-button>
                                    </div>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </vs-table>
                </div>
            </div>
        </div>
        <div>
            <vs-prompt title="Confirmation de suppression" color="danger" accept-text="Oui" cancel-text="Non" @accept="supprimer" :active.sync="activePrompt">
                <div class="text-center mx-auto">
                    Voulez-vous supprimer ce contrat ?
                </div>
            </vs-prompt>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import * as moment from 'moment'
    export default {
        metaInfo: {title: 'Contrats existants'},
        layout: Layout,
        data() {
            return {
                selected: null,
                activePrompt: false,
            }
        },
        props: {
            contrats: Array,
            flash: Object,
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD/MM/YYYY');
            },
            openDialog(val) {
                this.selected = val;
                this.activePrompt = true;
            },
            supprimer() {
                this.$inertia.delete(this.route('contrat.delete', this.selected))
            },

        },
        mounted() {
            if(this.flash.success) {
                this.$vs.notify({
                    title:'Message de succès',
                    text: this.flash.success,
                    color: '#17c964',
                    time: 5000,
                    position: 'top-right',
                    icon: 'mail'
                })
            }
            if (this.flash.error) {
                this.$vs.notify({
                    title:'Message de succès',
                    text: this.flash.error,
                    color: '#f2135d',
                    time: 5000,
                    position: 'top-right',
                    icon: 'mail'
                })
            }
        },
    }
</script>

<style scoped>

</style>
