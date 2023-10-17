<script setup>
import { computed, onMounted, ref } from 'vue';
import NavigationComponent from './NavigationComponent.vue';
import { useRoute } from 'vue-router';
import Tooltip from 'primevue/tooltip';
import axios from 'axios';
import Carousel from 'primevue/carousel';

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

const roomImages = {
    suite: [
        'https://i.ibb.co/pW71Ff9/suite1.png',
        'https://i.ibb.co/fDRmKhf/suite2.png',
        'https://i.ibb.co/Sr6Bw4k/suite3.png',
        'https://i.ibb.co/p3btt33/suite4.png'
    ],
    singola: [
        'https://i.ibb.co/98PxRQh/single1.png',
        'https://i.ibb.co/nBWxqcT/single2.png',
        'https://i.ibb.co/CV8678j/single3.png',
        'https://i.ibb.co/18gxDXz/single4.png'
    ],
    doppia: [
        'https://i.ibb.co/D94ML6s/double1.png',
        'https://i.ibb.co/w6qQNH7/double2.png',
        'https://i.ibb.co/HnbkStF/double3.png',
        'https://i.ibb.co/YcMx0bM/double4.png'
    ]
};
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

    <div class="title">Reserve a room</div>

    <div class="rooms-info">
        <div v-for="roomType in roomTypes" :key="roomType.type" class="room-type-info">
            <h3>{{ roomType.type.charAt(0).toUpperCase() + roomType.type.slice(1) }}</h3>
            <!-- Applica la classe custom-carousel al componente Carousel -->
            <Carousel :value="roomImages[roomType.type]" :numVisible="1" :numScroll="1" :circular="true" class="custom-carousel">
                <template #item="slotProps">
                    <img :src="slotProps.data" alt="Room Image" class="room-image" />
                </template>
            </Carousel>
            <p>Prezzo: €{{ roomType.price }}</p>
            <p>Camere disponibili: {{ roomType.available }}</p>
        </div>
    </div>

</template>

<style scoped>

.rooms-info {
    margin-top: 50px;
    width: 100vw;
    display: flex;
    justify-content: center;
}

.room-type-info{
    width: calc(100% / 4);

}

.custom-carousel {
    width: 300px;  /* Modifica a seconda delle tue esigenze */
    height: 200px; /* Modifica a seconda delle tue esigenze */
}

.room-image {
    max-width: 100%;
    height: auto;
}



</style>
