<template>
    <div class="container mx-auto mt-6">
        <div class="grid grid-cols-2 gap-4 mx-8 shadow-2xl border border-gray-300 overflow-hidden rounded">
            <div id="contrat" class="vx-card card-overlay h-64 withHover">
                <div class="vx-card__header">
                    <div class="vx-card__title">
                        <h4 class="text-white font-bold uppercase">Contrats standards</h4>
                    </div>
                </div>
                <div class="vx-card__collapsible-content vs-con-loading__container">
                    <div class="vx-card__body">
                        <div class="text-center">
                            <inertia-link :href="route('contrats.index')"
                                          class="text-white uppercase text-xl hover:text-gray-400 font-bold font-serif">Créer un nouveau contrat</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
            <div id="card-cover" class="vx-card card-overlay h-64 withHover">
                <div class="vx-card__header">
                    <div class="vx-card__title">
                        <h4 class="text-white font-bold uppercase">Contrats standards</h4>
                    </div>
                    </div>
                <div class="vx-card__collapsible-content vs-con-loading__container">
                    <div class="vx-card__body">
                        <div class="text-center">
                            <inertia-link :href="route('contrats.existant')"
                                          class="text-white uppercase text-xl hover:text-gray-400 font-bold font-serif">Visualisez les contrats déja crées</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Layout from '@/Shared/Layout';

    export default {
        metaInfo: {title: 'Contrats'},
        layout: Layout,
    }
</script>

<style scoped>
    #card-cover {
        background: linear-gradient(120deg, rgba(247, 97, 161, 0.5), rgba(140, 27, 171, 0.8)),url("/assets/images/maison_contrat.jpg");
        color: rgb(255, 255, 255);
        background-size: cover !important;
    }
    #contrat {
        background: linear-gradient(120deg, rgba(247, 97, 161, 0.5), rgba(140, 27, 171, 0.8)),url("/assets/images/contrat.jpg");
        color: rgb(255, 255, 255);
        background-size: cover !important;
    }
</style>
