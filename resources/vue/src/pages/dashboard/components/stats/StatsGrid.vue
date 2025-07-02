<template>
    <div class="px-4 mt-4 mb-2 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <StatisticsCardAlpha
            v-for="(card, index) in cards"
            :key="index"
            :title="card.title"
            :icon="card.icon"
            :count="card.count"
            :percentage="card.percentage"
            :percentage-text="card.percentageText"
        />
    </div>
</template>

<script>
    import StatisticsCardAlpha from '@affiliateComponents/cards/StatisticsCardAlpha.vue';

    export default {
        name: 'StatsGrid',
        components: {
            StatisticsCardAlpha,
        },
        props: {
            cards: {
                type: Array,
                default: () => [],
            }
        }
    }
</script>