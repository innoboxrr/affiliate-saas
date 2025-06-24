<template>
    <div class="p-4 md:p-12 lg:p-16 bg-white dark:bg-gray-800 overflow-hidden dark:border-gray-700">
        <!-- Dialog 1: Invitar Afiliados -->
        <div v-if="data.view === 'invite-affiliates'">
            <invite-affiliates-documentation :program="data.program" />
        </div>

        <!-- Dialog 2: How it works -->
        <div v-else-if="data.view === 'how-it-works'">
            <how-it-works-documentation :program="data.program" />
        </div>

        <!-- Dialog 3: Frontend events and conversions -->
        <div v-else-if="data.view === 'frontend-events'">
            <frontend-events-documentation :program="data.program" />
        </div>

        <!-- Dialog 4: Backend events and conversions -->
        <div v-else-if="data.view === 'backend-events'">
            <backend-events-documentation :program="data.program" />    
        </div>

        <div v-else-if="data.view === 'local-events'">
            <local-events-documentation :program="data.program" />    
        </div>
    </div>
</template>

<script>
import InviteAffiliatesDocumentation from './partials/InviteAffiliatesDocumentation.vue';
import HowItWorksDocumentation from './partials/HowItWorksDocumentation.vue';
import FrontendEventsDocumentation from './partials/FrontendEventsDocumentation.vue';
import BackendEventsDocumentation from './partials/BackendEventsDocumentation.vue';
import LocalEventsDocumentation from './partials/LocalEventsDocumentation.vue';
export default {
    components: {
        InviteAffiliatesDocumentation,
        HowItWorksDocumentation,
        FrontendEventsDocumentation,
        BackendEventsDocumentation,
        LocalEventsDocumentation
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        callback: {
            type: Function,
            required: true
        }
    },
    methods: {
        createAppointmentFormSubmitted() {
            this.callback({ event: 'RecommendationDialog' });
        }
    }
};
</script>
