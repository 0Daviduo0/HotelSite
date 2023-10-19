<script setup>
import NavigationComponent from './NavigationComponent.vue';
import { useRoute } from 'vue-router';
import Tooltip from 'primevue/tooltip';

const route = useRoute();

</script>

<template>

    <NavigationComponent>
        <template #left-buttons>
            <div class="sides">
                <div 
                    v-tooltip.top="route.path === '/' ? 'you are here' : ''"
                >
                    <div 
                        class="homeBtn button circular" 
                        :class="{ 'disabled-link': route.path === '/' }"
                    >
                        <router-link to="/" style="text-decoration: none; color: inherit">
                            <i class="pi pi-home"></i>
                        </router-link>
                    </div>

                </div>
                <div 
                    v-tooltip.top="route.path === '/overview' ? 'you are here' : ''"
                >

                    <div 
                        class="homeBtn button circular" 
                        :class="{ 'disabled-link': route.path === '/overview' }"
                    >
                        <router-link to="/overview" style="text-decoration: none; color: inherit">
                            <i class="pi pi-info"></i>
                        </router-link>
                    </div>
                </div>

            </div>
        </template>

        <!-- Title -->
        <template #title>
            An Hotel Experience like never before
        </template>

        <!-- Right-side buttons -->
        <template #right-buttons>
            <div class="sides">
                <div 
                    v-tooltip.top="route.path === '/reserve/details' ? 'you are here' : ''"
                >
                    <div 
                        class="reserveBtn button circular" 
                        :class="{ 'disabled-link': route.path === '/reserve' }"
                    >
                        <router-link to="/reserve" style="text-decoration: none; color: inherit">
                            <i class="pi pi-ticket"></i>
                        </router-link>
                    </div>
                </div>
                <div 
                    v-tooltip.top="route.path === '/about' ? 'you are here' : ''"
                >
                    <div 
                        class="homeBtn button circular" 
                        :class="{ 'disabled-link': route.path === '/about' }"
                    >
                        <router-link to="/about" style="text-decoration: none; color: inherit">
                            <i class="pi pi-comments"></i>
                        </router-link>
                    </div>

                </div>
            </div>
           
        </template>
    </NavigationComponent>

</template>

<style scoped>

</style>