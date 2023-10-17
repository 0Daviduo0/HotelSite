<script setup>
import { computed, onMounted, ref } from 'vue';
import NavigationComponent from './NavigationComponent.vue';
import { useRoute } from 'vue-router';
import Tooltip from 'primevue/tooltip';
import axios from 'axios';

const route = useRoute();
const roomsData = ref([]);

onMounted(async () => {
    try {
        const { data } = await axios.get('http://localhost:8000/api/rooms');
        roomsData.value = data;
    } catch (error) {
        console.error("Errore nel recupero dei dati delle camere:", error);
    }
});

const roomTypes = computed(() => {
    const types = ['suite', 'singola', 'doppia'];
    return types.map(type => {
        const roomsOfType = roomsData.value.filter(room => room.type === type);
        const availableRooms = roomsOfType.filter(room => room.is_available === 1).length;
        return {
            type,
            price: roomsOfType[0]?.price || 0,
            available: availableRooms
        };
    });
});
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
                    v-tooltip.top="route.path === '/reserve' ? 'you are here' : ''"
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

    <div class="rooms-info">
        <div v-for="roomType in roomTypes" :key="roomType.type" class="room-type-info">
            <h3>{{ roomType.type.charAt(0).toUpperCase() + roomType.type.slice(1) }}</h3>
            <p>Prezzo: €{{ roomType.price }}</p>
            <p>Camere disponibili: {{ roomType.available }}</p>
        </div>
    </div>

</template>

<style scoped>

.room-type-info {
    margin-bottom: 20px;
}

</style>
