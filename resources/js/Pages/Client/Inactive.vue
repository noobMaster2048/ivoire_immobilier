<template>
    <div class="container mx-auto">
        <div>
            <h1 class="font-bold text-3xl text-orange-500 mb-8 mx-8">Clients désactivés</h1>
        </div>
        <div>
            <div class="container px-4 mx-auto border border-gray-300 rounded-lg shadow-2xl overflow-x-auto bg-white">
                <vs-table :data="clients" pagination noDataText="Aucune donnée disponibe" max-items="15">
                    <template slot="header">
                        <h3>Clients</h3>
                    </template>
                    <template slot="thead">
                        <vs-th>Nom</vs-th>
                        <vs-th>Prénoms</vs-th>
                        <vs-th>Profession</vs-th>
                        <vs-th>Cni</vs-th>
                        <vs-th>Date de naissance</vs-th>
                        <vs-th>Lieu de naissance</vs-th>
                        <vs-th>Téléphone 1</vs-th>
                        <vs-th>Téléphone 2</vs-th>
                    </template>
                    <template slot-scope="{data}">
                        <vs-tr v-for="item in data" :key="item.id" :data="item">
                            <vs-td :data="item.nom">{{item.nom}}</vs-td>
                            <vs-td :data="item.prenom">{{item.prenom}}</vs-td>
                            <vs-td :data="item.profession">{{item.profession}}</vs-td>
                            <vs-td :data="item.profession">{{item.profession}}</vs-td>
                            <vs-td :data="item.cni">{{item.cni}}</vs-td>
                            <vs-td :data="item.date_naissance">{{item.date_naissance}}</vs-td>
                            <vs-td :data="item.lieu_naissance">{{item.lieu_naissance}}</vs-td>
                            <vs-td :data="item.tel_principal">{{item.tel_principal}}</vs-td>
                            <vs-td>
                                <div class="vx-row">
                                    <vs-button class="mx-2" size="small" color="success" icon="backup" type="border" @click="activer(item.id)">Réactiver</vs-button>
                                    <vs-button class="mx-2" size="small" color="danger" icon="delete_outline" type="border" @click="openDialog(item.id)">Supprimer définitivement</vs-button>
                                </div>
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
            </div>
            <div>
                <vs-prompt title="Confirmation de suppression" color="danger" accept-text="Oui" cancel-text="Non" @accept="supprimer" :active.sync="activePrompt">
                    <div class="text-center mx-auto">
                        Voulez-vous supprimer définitivement ce client ?
                    </div>
                </vs-prompt>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';

    export default {
        metaInfo: {title: 'Clients inactifs'},
        layout: Layout,
       props: ['clients', 'flash'],
        data () {
            return {
                activePrompt: false,
                selected: null,
            }
        },
        methods: {
            supprimer() {
                this.$inertia.delete(this.route('client.supprimer', this.selected)).then(() => {
                    if (this.flash.error) {
                        this.$vs.notify({
                            title: 'Notification',
                            text: this.flash.error,
                            color: '#f2135d',
                            time: 5000,
                            position: 'top-right',
                            icon: 'mail'
                        })
                    }
                })
            },
            openDialog(val) {
                this.selected = val;
                this.activePrompt = true;
            },
            activer(val) {
                this.$inertia.put(this.route('client.active', val)).then(() => {
                    if (this.flash.success) {
                        this.$vs.notify({
                            title: 'Notification',
                            text: this.flash.success,
                            color: '#17c964',
                            time: 5000,
                            position: 'top-right',
                            icon: 'mail'
                        })
                    }
                });

            }
        },

    }
</script>

<style scoped>

</style>
