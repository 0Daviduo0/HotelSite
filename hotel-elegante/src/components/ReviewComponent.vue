<template>
    <div class="clientReview">
        <Avatar :image="avatarImage" class="mr-2 customAvatar" shape="circle" />
        <div class="review">
            <div class="reviewParagraph">
                {{ reviewText }}
            </div>
            <div class="stars">
                <i v-for="star in Math.floor(rating)" :key="star" class="pi pi-star-fill" :style="{color: '#b97533'}"></i>
                <div v-if="rating % 1 !== 0" class="half-star">
                    <i class="pi pi-star-fill colored"></i>
                    <div class="overlay"></div>
                </div>
                <i v-for="emptyStar in 5 - Math.ceil(rating)" :key="'empty-' + emptyStar" class="pi pi-star-fill" :style="{color: 'gray'}"></i>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    avatarImage: {
      type: String,
      required: true
    },
    reviewText: {
      type: String,
      required: true
    },
    rating: {
      type: Number,
      required: true,
      validator: value => (value >= 0.5 && value <= 5 && (value * 2) % 1 === 0)
    }
});

const getStarClass = (star) => {
    const fullStars = Math.floor(props.rating);
    const hasHalfStar = (props.rating - fullStars) >= 0.5;

    if (star <= fullStars) {
      return 'pi pi-star-fill';
    } else if (star === fullStars + 1 && hasHalfStar) {
      return 'pi pi-star-fill';
    } else {
      return 'pi pi-star';
    }
}
</script>
  
<style scoped>
  .clientReview{
    margin: 0 auto;
    margin-top: 20px;
    padding: 15px;
    width: 90%;
    height: 130px;
    border: 1px solid #b97533;
    border-radius: 15px;
    display: flex;
    align-items: center;
    overflow: hidden;
    }

    .customAvatar {
        min-width: 80px;
        min-height: 80px;
        line-height: 80px; /* Questo è per centrare il contenuto, se hai un testo o un'icona all'interno */
    }

    .review{
        display: flex;
        flex-direction: column;
    }



    .reviewParagraph::before, .reviewParagraph::after {
        content: url("../assets/symbols/quotation-marks.svg");
        position: absolute;
        opacity: 0.3;  /* Imposta l'opacità come desideri, 0.3 è solo un esempio */
        z-index: -1;   /* Assicura che le virgolette stiano dietro al testo */
    }

    .reviewParagraph::before {
        top: 0;
        left: 0;
        transform: rotate(-15deg);
    }

    .reviewParagraph::after {
        bottom: 0;
        right: 30px;
        transform: scaleY(-1) scaleX(-1) rotate(-15deg);

    }

    .reviewParagraph{
        position: relative;  /* Rende il descrParagraph un elemento padre posizionato per gli pseudo-elementi */
        padding: 30px 30px 0px 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .stars{
        padding: 0px 30px 30px 30px;
        margin-top: 10px;
        display: flex;
        justify-content: center;
    }

    .half-star {
        position: relative;
        width: 24px; /* Puoi modificare questa dimensione a seconda delle tue necessità */
        height: 24px;
        overflow: hidden;
    }

    .half-star .pi-star-fill {
        width: 100%;
        height: 100%;
        color: #b97533; /* Questo è un giallo meno acceso rispetto a "gold" */
    }

    .half-star .overlay {
        position: absolute;
        top: 0;
        right: 3px;
        width: 50%;
        height: 100%;
        background-color: white;
    }
</style>
  