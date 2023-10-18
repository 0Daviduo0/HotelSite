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

const hoveredStatus = ref({
    suite: false,
    singola: false,
    doppia: false
});


const onHover = (roomType) => {
    hoveredStatus.value[roomType] = true;
};

const onLeave = (roomType) => {
    hoveredStatus.value[roomType] = false;
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

    <div class="wrapper">
        <div v-for="roomType in roomTypes" :key="roomType.type" class="rooms-info">
            <div class="room-type-info"
                v-bind:class="{ 'hovered': hoveredStatus[roomType.type] }"
            >
                <div class="title" style="font-size: 22px; padding-bottom: 10px;">{{ roomType.type.charAt(0).toUpperCase() + roomType.type.slice(1) }}</div>
                <!-- Applica la classe custom-carousel al componente Carousel -->
                <Carousel :value="roomImages[roomType.type]" :numVisible="1" :numScroll="1" :circular="true" class="custom-carousel">
                    <template #item="slotProps">
                        <img :src="slotProps.data" alt="Room Image" class="room-image" />
                    </template>
                </Carousel>
                <div class="infos">
                    <div class="info-box"><span class="symbol"> <i class="pi pi-dollar"></i></span>{{ roomType.price }}</div>
                    <div class="info-box"><span class="symbol"> <i class="pi pi-building"></i></span> {{ roomType.available }}</div>
                </div>
            </div>
            <div class="reserve"
                @mouseover="onHover(roomType.type)" 
                @mouseleave="onLeave(roomType.type)"
            >
                I choose this!
            </div>
        </div>
    </div>
    

</template>

<style scoped>

.wrapper{
    margin-top: 50px;
    width: 100vw;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-left: 30px;
    margin-right: 30px;
}

.room-type-info{
    width: 380px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border: 3px solid rgba(128, 128, 128, 0.582);
    border-radius: 8px;
    padding: 10px;
}

.custom-carousel {
    width: 350px;  /* Modifica a seconda delle tue esigenze */
}

.room-image {
    max-width: 100%;
    height: auto;
}

.infos{
    margin: 10px 0px;
    display: flex;
    width: 100%;
    justify-content: center;
    gap: 40px;
}

.symbol{
    border: 1px solid white;
    background-color: #fff;
    color: #b97533;
    border-radius: 50%;
    padding: 3px 5px;
    margin-right: 7px;
}

.info-box{
    border: 1px solid #b97533;
    border-radius: 8px;
    background-color: #b97533;
    color: #fff;
    padding: 10px 7px;
}

.reserve{
    border: 1px solid rgba(128, 128, 128, 0.582);
    border-radius: 8px;
    color: #000;
    margin-top: 20px;
    display: flex;
    justify-content: center;
    padding: 10px 7px;
}

.reserve:hover{
    border: 1px solid #b97533;
    background-color: #b97533;
    color: white;
}

.room-type-info.hovered {
    border: 3px solid #b97533;
}

</style>
