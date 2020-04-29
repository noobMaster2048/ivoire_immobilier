<template>
    <div class="container mx-auto">
        <div class="bg-orange-500 mt-6">
            <h1 class="mb-8 mx-8 font-bold text-3xl">
                <span class="text-white font-medium">Tableau de bord</span>
            </h1>
        </div>
        <div class="vx-row pb-6">
            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4">
                <div class="vx-card overflow-hidden mb-base">
                    <div class="vx-card__collapsible-content vs-con-loading__container">
                        <div>
                            <div class="p-6 text-center">
                                <vs-icon icon="account_circle" bg="primary" color="#91c8ff" size="large" round></vs-icon>
                                <div class="truncate">
                                    <h2 class="mb-1 font-bold">{{total_clients}}</h2>
                                    <span class="uppercase">Clients enregistrés</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4">
                <div class="vx-card overflow-hidden mb-base">
                    <div class="vx-card__collapsible-content vs-con-loading__container">
                        <div>
                            <div class="p-6 text-center">
                                <vs-icon icon="home" bg="success" color="#69ffb4" size="large" round></vs-icon>
                                <div class="truncate">
                                    <h2 class="mb-1 font-bold">{{maisons_total}}</h2>
                                    <span class="uppercase">Maisons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4">
                <div class="vx-card overflow-hidden mb-base">
                    <div class="vx-card__collapsible-content vs-con-loading__container">
                        <div>
                            <div class="p-6 text-center">
                                <vs-icon icon="home" bg="success" color="#69ffb4" size="large" round></vs-icon>
                                <div class="truncate">
                                    <h2 class="mb-1 font-bold">{{maisons_dispo.total}}</h2>
                                    <span class="uppercase">Maisons disponibles</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4">
                <div class="vx-card overflow-hidden mb-base">
                    <div class="vx-card__collapsible-content vs-con-loading__container">
                        <div>
                            <div class="p-6 text-center">
                                <vs-icon icon="account_balance" bg="warning" color="#d08508" size="large" round></vs-icon>
                                <div class="truncate">
                                    <h2 class="mb-1 font-bold">{{programmes}}</h2>
                                    <span class="uppercase">Programmes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-8 pb-6">
            <div>
                <vs-card>
                    <div class="p-6 text-center">
                        <vs-icon icon="polymer" bg="success" size="large" round color="#fff"></vs-icon>
                        <div class="truncate">
                            <h2 class="mb-1 font-bold">{{souscriptions.total}}</h2>
                            <span class="uppercase">Souscriptions</span>
                        </div>
                    </div>
                </vs-card>
            </div>
            <div>
                <vs-card>
                    <div class="p-6 text-center">
                        <vs-icon bg="success" icon="local_atm" size="large" round color="#fff"></vs-icon>
                        <div class="truncate">
                            <h2 class="mb-1 font-bold">{{montant_maisons.total | number('0,0', { thousandsSeparator: ' ' })}} Frs</h2>
                            <span class="uppercase">somme des maisons enregistrés</span>
                        </div>
                    </div>
                </vs-card>
            </div>
            <div>
                <vs-card>
                    <div class="p-6 text-center">
                        <vs-icon bg="success" icon="local_atm" size="large" round color="#fff"></vs-icon>
                        <div class="truncate">
                            <h2 class="mb-1 font-bold">{{montant_apport.total | number('0,0', { thousandsSeparator: ' ' })}} Frs</h2>
                            <span class="uppercase">Montant des apports initiaux</span>
                        </div>
                    </div>
                </vs-card>
            </div>
            <div>
                <vs-card>
                    <div class="p-6 text-center">
                        <vs-icon bg="success" icon="local_atm" size="large" round color="#fff"></vs-icon>
                        <div class="truncate">
                            <h2 class="mb-1 font-bold">{{mont_maisons_sous.total | number('0,0', { thousandsSeparator: ' ' })}}</h2>
                            <span class="uppercase">montant des maisons soucrites</span>
                        </div>
                    </div>
                </vs-card>
            </div>
            <div>
                <vs-card>
                    <div class="p-6 text-center">
                        <vs-icon bg="success" icon="local_atm" size="large" round color="#fff"></vs-icon>
                        <div class="truncate">
                            <h2 class="mb-1 font-bold">{{paiement_attente.total}}</h2>
                            <span class="uppercase">paiement en attente de validité</span>
                        </div>
                    </div>
                </vs-card>
            </div>
            <div>
                <vs-card>
                    <div class="p-6 text-center">
                        <vs-icon bg="success" icon="local_atm" size="large" round color="#fff"></vs-icon>
                        <div class="truncate">
                            <h2 class="mb-1 font-bold">{{paiement_valide.total}}</h2>
                            <span class="uppercase">nombre de paiements validés</span>
                        </div>
                    </div>
                </vs-card>
            </div>
        </div>
        <div class="vx-row pb-6">
            <div class="vx-col w-full md:w-1/3">
                <div class="vx-card overflow-hidden mb-base">
                    <div class="vx-card__collapsible-content vs-con-loading__container">
                        <apexchart width="380" type="donut" :options="options" :series="series"></apexchart>
                    </div>
                </div>
            </div>
            <div class="vx-col w-full md:w-1/3">
                <div class="vx-card overflow-hidden mb-base">
                    <div class="vx-card__collapsible-content vs-con-loading__container">
                        <apexchart width="380" type="line" :options="optionsLine" :series="seriesLines"></apexchart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Layout from '@/Shared/layout';
    import VueApexCharts  from 'vue-apexcharts'

    export default {
        name: "Dashboard",
        metaInfo: {title: 'Tableau de bord'},
        layout: Layout,
        components: {
          'apexchart':VueApexCharts
        },
        props: ['maisons_total', 'maisons_dispo', 'total_clients','montant_apport', 'mont_maisons_sous',
            'programmes', 'souscriptions', 'montant_maisons', 'paiement_attente', 'paiement_valide'],
        data() {
            return {
                options: {},
                optionsLine: {
                    chart: {
                        id: 'vuechart-example'
                    },
                    xaxis: {
                        categories: [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019]
                    }
                },
                series: [44, 55, 41, 17, 15],
                seriesLines: [{
                    name: 'exemple graphique',
                    data: [30, 40, 45, 50, 49, 60, 70, 91, 55, 89]
                }]
            }
        }

    }
</script>
