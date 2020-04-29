<template>
    <div class="container mx-auto">
        <div>
            <h1 class="text-orange-500 uppercase text-3xl font-bold mx-8 mb-8">statistiques</h1>
        </div>
        <div class="vx-row">
            <div class="vx-col w-full">
                <div>
                    <vs-tabs position="left" color="success">
                        <vs-tab label="Clients">
                            <vs-collapse>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">Envoyé par</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="envois">
                                                    <template slot="thead">
                                                        <vs-th>Envoyé par</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.id">
                                                            <vs-td :data="item.nom">{{item.nom}}</vs-td>
                                                            <vs-td :data="item.effectif">{{item.effectif}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="envois.length > 0">
                                                    <charts type="donut" width="380" :options="envoiChartsLabel" :series="envoiChartsValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">Profession</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="profession">
                                                    <template slot="thead">
                                                        <vs-th>Profession</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.profession">
                                                            <vs-td :data="item.profession">{{item.profession}}</vs-td>
                                                            <vs-td :data="item.effectif">{{item.effectif}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="profession.length > 0">
                                                    <charts type="donut" width="380" :options="profChartLabels" :series="professionChartValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">Residence</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="residences">
                                                    <template slot="thead">
                                                        <vs-th>Résidence</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                            <vs-td :data="item.label">{{item.label}}</vs-td>
                                                            <vs-td :data="item.total">{{item.total}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="residences.length > 0">
                                                    <charts type="donut" width="380" :options="residChartLabels" :series="residChartValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">Réseau téléphonique principal</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="principal">
                                                    <template slot="thead">
                                                        <vs-th>Réseau</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                            <vs-td :data="item.label">{{item.label}}</vs-td>
                                                            <vs-td :data="item.total">{{item.total}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="principal.length > 0">
                                                    <charts type="donut" width="380" :options="principalLabels" :series="principalValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">Réseau téléphonique sécondaire</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="secondaire">
                                                    <template slot="thead">
                                                        <vs-th>Réseau</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                            <vs-td :data="item.label">{{item.label}}</vs-td>
                                                            <vs-td :data="item.total">{{item.total}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="secondaire.length > 0">
                                                    <charts type="donut" width="380" :options="secondaireLabels" :series="secondaireValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                            </vs-collapse>
                        </vs-tab>
                        <vs-tab label="Maisons">
                            <vs-collapse>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">standing</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="standing">
                                                    <template slot="thead">
                                                        <vs-th>Standing</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                            <vs-td :data="item.label">{{item.label}}</vs-td>
                                                            <vs-td :data="item.total">{{item.total}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="standing.length > 0">
                                                    <charts type="donut" width="380" :options="standingChartLabels" :series="standingChartValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                            </vs-collapse>
                        </vs-tab>
                        <vs-tab label="Souscriptions">
                            <vs-collapse>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase"> Option de paiement</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="options">
                                                    <template slot="thead">
                                                        <vs-th>Option de paiement</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                            <vs-td :data="item.label">{{item.label}} mois</vs-td>
                                                            <vs-td :data="item.total">{{item.total}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="options.length > 0">
                                                    <charts type="donut" width="380" :options="optionChartLabels" :series="optionChartValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                                <vs-collapse-item>
                                    <div slot="header">
                                        <span class="uppercase">Ecart de paiement</span>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <vs-table :data="ecarts">
                                                    <template slot="thead">
                                                        <vs-th>Ecart de paiement</vs-th>
                                                        <vs-th>Effectifs</vs-th>
                                                    </template>
                                                    <template slot-scope="{data}">
                                                        <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                            <vs-td :data="item.label">{{item.label}} mois</vs-td>
                                                            <vs-td :data="item.total">{{item.total}}</vs-td>
                                                        </vs-tr>
                                                    </template>
                                                </vs-table>
                                            </vs-card>
                                        </div>
                                        <div class="vx-col w-full lg:w-1/2">
                                            <vs-card>
                                                <div v-if="ecarts.length > 0">
                                                    <charts type="donut" width="380" :options="ecartChartLabels" :series="ecartChartValues"></charts>
                                                </div>
                                            </vs-card>
                                        </div>
                                    </div>
                                </vs-collapse-item>
                            </vs-collapse>
                        </vs-tab>
                        <vs-tab label="Reglements">
                           <vs-collapse>
                               <vs-collapse-item>
                                   <div slot="header">
                                       <span class="uppercase">Mode de reglement</span>
                                   </div>
                                   <div class="vx-row">
                                       <div class="vx-col w-full lg:w-1/2">
                                           <vs-card>
                                               <vs-table :data="reglements">
                                                   <template slot="thead">
                                                       <vs-th>Mode de reglement</vs-th>
                                                       <vs-th>Effectif</vs-th>
                                                   </template>
                                                   <template slot-scope="{data}">
                                                       <vs-tr v-for="item in data" :data="item" :key="item.label">
                                                           <vs-td :data="item.label">{{item.label}}</vs-td>
                                                           <vs-td :data="item.total">{{item.total}}</vs-td>
                                                       </vs-tr>
                                                   </template>
                                               </vs-table>
                                           </vs-card>
                                       </div>
                                       <div class="vx-col w-full lg:w-1/2">
                                           <vs-card>
                                               <div v-if="reglements.length > 0">
                                                   <charts type="donut" width="380" :options="reglementChartLabels" :series="reglementChartValues"></charts>
                                               </div>
                                           </vs-card>
                                       </div>
                                   </div>
                               </vs-collapse-item>
                           </vs-collapse>
                        </vs-tab>
                    </vs-tabs>
                </div>
                <div></div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';
    import VueApexCharts from 'vue-apexcharts'

    export default {
       layout: Layout,
        components: {
           'charts': VueApexCharts,
        },
        metaInfo: { title: 'Statistiques'},
        props: {
           envois: Array,
            profession: Array,
            reglements: Array,
            options: Array,
            ecarts: Array,
            standing: Array,
            residences: Array,
            principal: Array,
            secondaire: Array,
        },
        computed: {
           envoiChartsLabel() {
               return {
                   labels: this.envois.map(envoi => envoi.nom)
               }
           },
            envoiChartsValues() {
               return this.envois.map(envoi => envoi.effectif)
            },
            profChartLabels() {
               return {
                   labels: this.profession.map(p => p.profession)
               }
            },
            professionChartValues() {
               return this.profession.map(p => p.effectif)
            },
            reglementChartLabels() {
               return {
                   labels: this.reglements.map(r => r.label)
               }
            },
            reglementChartValues() {
               return this.reglements.map(r => r.total)
            },
            optionChartLabels() {
               return {
                   labels: this.options.map(o => o.label + " " + "mois")
                }
            },
            optionChartValues() {
               return this.options.map(o => o.total)
            },
            ecartChartLabels() {
               return {
                   labels: this.ecarts.map(e => e.label + " " + "mois")
               }
            },
            ecartChartValues() {
               return this.ecarts.map(e => e.total)
            },
            standingChartLabels() {
               return {
                   labels: this.standing.map(s => s.label)
               }
            },
            standingChartValues() {
               return this.standing.map(s => s.total)
            },
            residChartLabels() {
               return {
                   labels: this.residences.map(re => re.label)
               }
            },
            residChartValues() {
               return this.residences.map(re => re.total)
            },
            principalLabels() {
               return {
                   labels: this.principal.map(pr => pr.label)
               }
            },
            principalValues() {
               return this.principal.map(pr => pr.total)
            },
            secondaireLabels() {
                return {
                    labels: this.secondaire.map(se => se.label)
                }
            },
            secondaireValues() {
                return this.secondaire.map(se => se.total)
            }
        }
    }
</script>

<style scoped>

</style>
