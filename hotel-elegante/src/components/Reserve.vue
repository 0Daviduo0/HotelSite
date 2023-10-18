<script setup>
import { computed, onMounted, ref } from 'vue';
import NavigationComponent from './NavigationComponent.vue';
import { useRoute } from 'vue-router';
import Tooltip from 'primevue/tooltip';
import axios from 'axios';
import Carousel from 'primevue/carousel';


const isLoading = ref(true); // inizialmente impostato su true

onMounted(async () => {
    try {
        // await new Promise(resolve => setTimeout(resolve, 5000));  // aspetta 5 secondi
        const { data } = await axios.get('http://localhost:8000/api/rooms');
        roomsData.value = data;
    } catch (error) {
        console.error("Errore nel recupero dei dati delle camere:", error);
    } finally {
        isLoading.value = false; // imposta il caricamento su false sia che ci sia un successo che un errore
    }
});


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
    const types = ['suite', 'single', 'double'];
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
    single: [
        'https://i.ibb.co/98PxRQh/single1.png',
        'https://i.ibb.co/nBWxqcT/single2.png',
        'https://i.ibb.co/CV8678j/single3.png',
        'https://i.ibb.co/18gxDXz/single4.png'
    ],
    double: [
        'https://i.ibb.co/D94ML6s/double1.png',
        'https://i.ibb.co/w6qQNH7/double2.png',
        'https://i.ibb.co/HnbkStF/double3.png',
        'https://i.ibb.co/YcMx0bM/double4.png'
    ]
};

const roomDetails = {
    single: {
        description:
            "The main room area with a comfortable bed, offering a glimpse of the city through the window. An illustration of the ensuite bathroom, highlighting its modern fixtures and luxury feel. A dedicated workspace within the room, equipped with all essentials for a productive stay. A cozy lounge area in the room, perfect for relaxation and reading.",
        services: [
            { icon: "fa-solid fa-wifi", description: "Free WiFi" },
            { icon: "fa-solid fa-tv", description: "TV" },
            { icon: "fa-solid fa-bell-concierge", description: "Room Service" },
            { icon: "fa-solid fa-fan", description: "Air Conditioning" },
        ],
    },
    double: {
        description:
            "The main room area with twin beds, arranged to provide maximum comfort while ensuring a spacious feel. An illustration of the ensuite bathroom, designed with modern fixtures and twin sinks for the convenience of guests sharing the room. A lounge area within the room, perfect for guests to relax, watch TV, or enjoy a cup of tea. A dedicated workspace designed to accommodate two guests, ensuring both have ample space and amenities to work comfortably.",
        services: [
            { icon: "fa-solid fa-wifi", description: "Free WiFi" },
            { icon: "fa-solid fa-tv", description: "TV" },
            { icon: "fa-solid fa-bell-concierge", description: "Room Service" },
            { icon: "fa-solid fa-fan", description: "Air Conditioning" },
            { icon: "fa-solid fa-mug-hot", description: "Tea and Coffee Making Facilities" },
            { icon: "fa-solid fa-panorama", description: "City View" }
        ],
    },
    suite: {
        description:
            "The Bedroom area is designed for ultimate comfort and luxury, with a spacious king-sized bed and a seating area. The Bathroom, featuring a jacuzzi, rain shower, and high-end amenities to provide a spa-like experience. A living area furnished with modern decor and designed for relaxation and entertainment. The suite's private balcony, offering a serene spot to relax and enjoy the views, be it a romantic dinner or a peaceful morning coffee session.",
        services: [
            { icon: "fa-solid fa-wifi", description: "Free WiFi" },
            { icon: "fa-solid fa-tv", description: "TV" },
            { icon: "fa-solid fa-bell-concierge", description: "Room Service" },
            { icon: "fa-solid fa-mug-hot", description: "Tea and Coffee Making Facilities" },
            { icon: "fa-solid fa-hot-tub-person", description: "Jacuzzi" },
            { icon: "fa-solid fa-shower", description: "Rain Shower" },
            { icon: "fa-solid fa-fan", description: "Air Conditioning" },
            { icon: "fa-solid fa-door-open", description: "Private Balcony" },
            { icon: "fa-solid fa-gifts", description: "Luxury Amenities" },
        ],
    }
};

const hoveredStatus = ref({
    suite: false,
    single: false,
    double: false
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

    <div v-if="isLoading" class="loading-overlay">
        <i class="pi pi-spin pi-spinner" style="font-size: 2rem; color: #b97533"></i>
        <p> We are checking the Rooms... </p>
    </div>

    <div class="title">Reserve a room</div>

    <div class="wrapper">
        <div v-for="roomType in roomTypes" :key="roomType.type" class="rooms-info">
            <div class="room-type-info" v-bind:class="{ 'hovered': hoveredStatus[roomType.type] }">
                <div class="title" style="font-size: 22px; padding-bottom: 10px;">{{ roomType.type.charAt(0).toUpperCase() + roomType.type.slice(1) }}</div>
                <!-- Applica la classe custom-carousel al componente Carousel -->
                <Carousel :value="roomImages[roomType.type]" :numVisible="1" :numScroll="1" :circular="true" class="custom-carousel">
                    <template #item="slotProps">
                        <img :src="slotProps.data" alt="Room Image" class="room-image" />
                    </template>
                </Carousel>
                <div class="infos">
                    <div class="info-box">
                        <span class="symbol"> 
                            <i class="pi pi-dollar"></i>
                        </span>{{ roomType.price }}
                    </div>
                    <div class="info-box">
                        <span class="symbol"> 
                            <i class="pi pi-building"></i>
                        </span>{{ roomType.available }}
                    </div>
                </div>

            </div>

            <div class="services" v-if="roomDetails[roomType.type] && roomDetails[roomType.type].services">
                <div class="service" v-for="service in roomDetails[roomType.type].services" :key="service.description" v-bind:class="{ 'hovered': hoveredStatus[roomType.type] }">
                    <i :class="service.icon" v-tooltip.bottom="service.description"></i>
                </div>
            </div>
            <!-- Fine delle icone dei servizi -->

            <div class="description" v-if="roomDetails[roomType.type]">
                <p>{{ roomDetails[roomType.type].description }}</p>
                
            </div>
            <div class="reserve"
                @mouseover="onHover(roomType.type)" 
                @mouseleave="onLeave(roomType.type)"
            >
                i choose {{roomType.type}}
            </div>
        </div>
    </div>
    

</template>

<style scoped>

.loading-overlay {
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.9); /* sfondo bianco con leggera trasparenza */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 80px;
    height: 80px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.wrapper{
    margin-top: 50px;
    width: 100vw;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
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
    text-transform: uppercase;
}

.reserve:hover{
    border: 1px solid #b97533;
    background-color: #b97533;
    color: white;
}

.room-type-info.hovered {
    border: 3px solid #b97533;
}

.rooms-info{
    width: 380px;
}

.services{
    margin-top: 5px;
    display: flex;
    width: 380px;
    height: 50px;
    gap: 10px;
    justify-content: center;
    align-items: center;
}

.service{
    border: 1px solid grey;
    border-radius: 8px;
    padding: 5px 5px;
}

.service.hovered{
    border: 1px solid #b97533;
    background-color: #b97533;
    color: #fff;
}

.description{
    width: 380px;
    height: 210px;
}

</style>
