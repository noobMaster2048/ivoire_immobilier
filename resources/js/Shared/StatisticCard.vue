<template>
    <div>
        <vx-card class="overflow-hidden">
            <div slot="no-body">
                <div class="p-6">
                    <div class="truncate">
                        <h2 class="mb-1 font-bold">{{ statistic }}</h2>
                        <span>{{ statisticTitle }}</span>
                    </div>
                </div>
                <div class="line-area-chart" >
                    <vue-apex-charts ref="apexChart" :type="type" height=100 width='100%' :options="chartOptions" :series="chartData"></vue-apex-charts>
                </div>
            </div>
        </vx-card>
    </div>
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
export default {
    components: {
        VueApexCharts
    },
    props: {
        icon: {
            type: String,
            required: true
        },
        statistic: {
            type: [Number, String],
            required: true,
        },
        statisticTitle: {
            type: String,
        },
        color: {
            type: String,
            default: 'primary',
        },
        colorTo: {
          type: String
        },
        type: {
            type: String,
            default: 'line'
        },
        iconRight: {
            type: Boolean,
            default: false
        },
        hideChart: {
          type: Boolean,
          default: false,
        }
    }
}
</script>
