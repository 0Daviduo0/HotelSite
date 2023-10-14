<template>
    <div class="page">
        <div class="background" :class="{ 'blur-background': showText }"></div>
        <transition name="fade-from-bottom" appear>
            <div v-show="showText" class="title">
                <span style="font-family: 'Young Serif', serif; font-size: 40px;">
                    Welcome
                </span> <br>
                 to Hotel Elegante
            </div>
        </transition>
        <transition name="fade-from-bottom" appear>
            <div v-show="showText" @click="nextPage" class="button">
                Take a tour
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const nextPage = () => {
  router.push('/overview');
}

const showText = ref(false);

onMounted(() => {
  setTimeout(() => {
    showText.value = true;
  }, 1500);
});

</script>

<style scoped>
.page {
    position: relative;
    overflow: hidden;
}

.background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url(../assets/images/hero/HotelEntrance.png);
    background-repeat: no-repeat;
    background-size: cover;
    transition: filter 1s, transform 1s;
    z-index: 1;
}

.blur-background {
    filter: blur(5px);
    transform: scale(1.1);
}

.title, .button {
    position: relative;
    z-index: 2;
    /* Rimuovi questa regola */
    /* opacity: 0; */
    transform: translateY(0px);
}

.fade-from-bottom-enter-active {
    transition: opacity 1s, transform 1s;
}

.fade-from-bottom-enter {
    opacity: 0;
    transform: translateY(30px);
}

/* Aggiungi queste regole per mantenere la scritta e il pulsante visibili dopo l'animazione */
.fade-from-bottom-enter-to {
    opacity: 1;
    transform: translateY(0);
}

.fade-from-bottom-leave-active {
    transition: opacity 1s, transform 1s;
}

.fade-from-bottom-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

.fade-from-bottom-leave {
    opacity: 1;
    transform: translateY(0);
}




.button{
    margin-top: 20px;
}
</style>
