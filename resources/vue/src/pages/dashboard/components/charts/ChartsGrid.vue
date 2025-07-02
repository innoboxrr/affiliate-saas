<template>
    <div  class="flex flex-col p-2">        
        <template 
            v-for="row, index in chartRows"
            :key="`chart-row-${index}`">
            <div
                v-if="row.length === 2"
                class="w-full mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <div class="w-full px-2 mb-4 md:mb-0">
                        <component
                            :key="row[0].id"
                            :is="row[0].component"
                            v-bind="row[0].data"
                            :id="`chart-${row[0].id}`"
                            @updatePeriod="$emit('updatePeriod', $event)"
                            @viewReport="$emit('viewReport', $event)"
                        />
                    </div>
                    <div class="w-full px-2">
                        <component
                            :key="row[1].id"
                            :is="row[1].component"
                            v-bind="row[1].data"
                            :id="`chart-${row[1].id}`"
                            @updatePeriod="$emit('updatePeriod', $event)"
                            @viewReport="$emit('viewReport', $event)"
                        />
                    </div>
                </div>
            </div>
            <div
                v-else-if="row.length === 1" 
                class="w-full mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <div class="w-full px-2 mb-4 md:mb-0">
                        <component
                            :key="row[0].id"
                            :is="row[0].component"
                            v-bind="row[0].data"
                            :id="`chart-${row[0].id}`" 
                            @updatePeriod="$emit('updatePeriod', $event)"
                            @viewReport="$emit('viewReport', $event)"
                        />
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>

    export default {
        name: 'ChartsGrid',
        props: {
            chartRows: {
                type: Array,
                default: () => []
            }
        },
        emits: ['updatePeriod', 'viewReport'],
        mounted() {
            console.log(this.chartRows);
        }
    }
</script>